@extends('layout')
@section('mycss')
    <link rel="stylesheet" href="{{ url('css/admin/a_teacher.css') }}">
    <link rel="stylesheet" href="{{ url('css/admin/a_controls.css') }}">
@endsection
@section('navbar')
    @include('admin.adminNavBar')
@endsection
@section('contant')
    @if (session()->has('errorad'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>error</strong> Cant add teacher.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @php
            session()->forget('errorad');
        @endphp
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>error</strong> Cant delete teacher.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @php
            session()->forget('error');
        @endphp
    @endif
    @if (session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong> {{session('msg')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @php
            session()->forget('error');
        @endphp
    @endif
    <span class="filterIcon position-fixed"><i class="fas fa-filter"></i></span>
    <div class="d position-fixed">
        <form action="{{ route('admin.teacherView.filter') }}" class="con" method="POST">
            @csrf
            <div>
                <input class="form-control me-2" type="search" placeholder="@lang('lang.Search')" aria-label="Search"
                    name="search" />
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="subject" checked>
                <label class="form-check-label" for="subject"> @lang('lang.Subjects') </label>
                @if (session()->has('subjects'))
                    @foreach (session('subjects') as $data)
                        <div class="form-check">
                            <input class="form-check-input subject" type="radio" name="subject" id="exampleRadios1"
                                value=" {{ $data->S_id }}">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $data->S_name }}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="gender" name="genderOn" value="open"
                    checked>

                <label class="form-check-label" for="flexSwitchCheckChecked">@lang('lang.gender')</label>
                <div class="form-check">
                    <input class="form-check-input gender" type="radio" name="gender" id="exampleRadios1" value="male">
                    <label class="form-check-label" for="exampleRadios1">
                        @lang('lang.Male')
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input gender" type="radio" name="gender" id="exampleRadios1" value="female">
                    <label class="form-check-label" for="exampleRadios1">
                        @lang('lang.Female')
                    </label>
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="Scientific" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">@lang('lang.department')</label>

                <!-- SELECT * FROM `department` -->
                @if (session()->has('departments'))
                    @foreach (session('departments') as $data)
                        <div class="form-check">
                            <input class="form-check-input Scientific" type="radio" name="department" id="exampleRadios1"
                                value="{{ $data->D_id }}">
                            <label class="form-check-label" for="exampleRadios1">
                                {{ $data->D_name }}
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>
            <input type="submit" value="@lang('lang.Filter')" class="btn btn-outline-info btn-block mt-5 w-100">
        </form>
    </div>
    <!-- contant -->
    <div class="container">
        <div class="row">
            @if (session()->has('teachers'))
                @foreach (session('teachers') as $data)
                    <div class="col-12 col-lg-4 d-flex justify-content-center">
                        <a href="{{ route('admin.teacherView.show', $data->T_id) }}" class="btn">
                            <div class="teacherCard">
                                @if ($data->T_img != null)
                                    <img src="{{ url('upload/img/', $data->T_img) }}" alt="Person" class="card-img-top">
                                @else
                                    @if ($data->T_gender == 'male')
                                        <img src="{{ url('images/img_avatar.png') }}" alt="Person" class="card-img-top">
                                    @else
                                        <img src="{{ url('images/img_avatar2.png') }}" alt="Person" class="card-img-top">
                                    @endif
                                @endif
                                <div class="teacherBody">
                                    <i class="text-info fas fa-info-circle"></i>
                                </div>
                                <p class="text-center">
                                    {{ $data->T_fname }} {{ $data->T_lname }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
            <!--end contant-->
            <!-- start new teacher -->
            <div class="col-12 col-lg-4">
                <div class="teacherCard">
                    <button class="btn btn-outline-success addT"><i class="fas fa-plus-circle"></i></button>
                </div>
            </div>
            <!-- new teacher -->
            <div class="create">
                <div class="cont">
                    <h2>@lang('lang.Add new teacher'): </h2>
                    <i class="far fa-times-circle" id="exit"
                        style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                    <hr>

                    <form class="was-validated" action="{{ route('admin.teacherView.store') }}" method="POST">
                        @csrf
                        <div class="">
                            <div class="col-md-6 mb-3 w-100">
                                <input type="text" class="form-control is-invalid"
                                    aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.first name')"
                                    name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3 w-100">
                                <input type="text" class="form-control is-invalid"
                                    aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.last name')"
                                    name="last_name" required>
                            </div>
                            <input type="text" class="form-control is-invalid s1" maxlength="11"
                                aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.phone number')"
                                name="phone_number" required>
                            <label class="style-2">@lang('lang.Gender:')</label>
                            <div class="div-1">
                                <label for="male" class="gender">@lang('lang.Male')</label>
                                <input type="radio" id="male" name="gender" value="male" class="radio"
                                    checked>
                            </div>
                            <div class="div-1">
                                <label for="female" class="gender">@lang('lang.Female')</label>
                                <input type="radio" id="female" name="gender" value="female" class="radio">
                            </div>
                            <select id="inputState" class="form-control mt-3" name="subject_id">
                                <option selected>@lang('lang.Choose Subject')...</option>
                                @if (session()->has('all_subjects'))
                                    @foreach (session('all_subjects') as $data)
                                        <option value="{{ $data->S_id }}">
                                            {{ $data->D_name }} - {{ $data->S_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <input type="submit" value="@lang('lang.Add teacher')" class="btn btn-success addTeasher">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myjs')
    <script src="{{ url('js/admin/a_teacher.js') }}"></script>
@endsection

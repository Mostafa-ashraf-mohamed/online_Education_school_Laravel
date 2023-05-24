@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_profile.css') }}" rel="stylesheet">
    <link href="{{ url('css/admin/a_setting.css') }}" rel="stylesheet">
@endsection

@section('navbar')
    @include('admin.adminNavBar')
@endsection

@section('contant')

@if (session()->has('msg'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>!</strong> {{session('msg')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @php
      session()->forget('msg');
  @endphp
@endif
    <!-- body -->
    <div class="container mt-5">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div id="btn1" class="btn-toggle btn-block active" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    @lang('lang.Departments')
                    <i id="ibtn1" class="float-right fas fa-caret-right"></i>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body pr-5 pl-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('lang.department')</th>
                                    <th scope="col">@lang('lang.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->D_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.setting.deleteDepartment', $data->D_id) }}"
                                                class="btn btn-danger">@lang('lang.delete')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-outline-success btn-block w-100" id="newDepartment"><i
                                class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="btn2" class="btn-toggle btn-block" type="button" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    @lang('lang.Subjects')
                    <i id="ibtn2" class="float-right fas fa-caret-right"></i>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body pr-5 pl-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('lang.department')</th>
                                    <th scope="col">@lang('lang.subject')</th>
                                    <th scope="col">@lang('lang.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->D_name }}</td>
                                        <td>{{ $data->S_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.setting.deleteSubject', $data->S_id) }}"
                                                class="btn btn-danger">@lang('lang.delete')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-outline-success btn-block w-100" id="newSubject"><i
                                class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div id="btn3" class="btn-toggle btn-block" type="button" data-toggle="collapse"
                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    @lang('lang.Block list')
                    <i id="ibtn3" class="float-right fas fa-caret-right"></i>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body pr-5 pl-5">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('lang.full_name')</th>
                                    <th scope="col">@lang('lang.email')</th>
                                    <th scope="col">@lang('lang.phone')</th>
                                    <th scope="col">@lang('lang.Teacher name')</th>
                                    <th scope="col">@lang('lang.Comment')</th>
                                    <th scope="col">@lang('lang.Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blocks as $data)
                                    <tr>
                                        <th scope="row">{{ $data->B_id }}</th>
                                        <td>{{ $data->St_fname }} {{ $data->St_lname }}</td>
                                        <td>{{ $data->St_email }}</td>
                                        <td>{{ $data->St_phNumber }}</td>
                                        <td>{{ $data->T_name }}</td>
                                        <td>{{ $data->comment }}</td>
                                        <td>
                                            <a  class="btn btn-info" href="{{route('admin.setting.blockremove',$data->St_id)}}">@lang('lang.remove block')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add department -->
    <div>
        <div class="department">
            <div class="cont">
                <i class="far fa-times-circle" id="exit"
                    style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                <h2>@lang('lang.Department name'):</h2>
                <div style="text-align: center;">
                    <hr>
                    <form action="{{route('admin.setting.storeDepartment')}}" method="POST">
                        @csrf
                        <br>
                        <input type="text" class="form-control" name="department" id="department" require>
                        <input type="submit" value="@lang('lang.Add')" id="add"
                            class="btn btn-info btn-block mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add subject -->
    <div>
        <div class="subject">
            <div class="cont">
                <i class="far fa-times-circle" id="exit2"
                    style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                <h2>@lang('lang.Subject name'):</h2>
                <div style="text-align: center;">
                    <hr>
                    <form action="{{route('admin.setting.storeSubject')}}" method="POST">
                        @csrf
                        <select name="Did" class="form-control" require>
                            <option selected>@lang('lang.Choose Department')...</option>
                            @foreach ($departments as $data)
                                <option value="{{ $data->D_id }}">{{ $data->D_name }}</option>
                            @endforeach

                        </select>
                        <br>
                        <input type="text" class="form-control" placeholder="@lang('lang.Subject name')"
                            name="subject" id="subject" require>
                        <input type="submit" value="@lang('lang.Add')" id="addSubject"
                            class="btn btn-info btn-block mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myjs')
    <script src="{{ url('js/admin/a_setting.js') }}"></script>
@endsection

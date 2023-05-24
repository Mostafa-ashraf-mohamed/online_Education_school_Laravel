@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_profile.css') }}" rel="stylesheet">
@endsection
@section('navbar')
    @include('teacher.teacherNavBar')
@endsection
@section('contant')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12 p-0">
                <div class="profile-img">
                    @if ($teacher->getImg() != "")
                        <img src="{{ url('upload/img', $teacher->getImg()) }}" alt="Person" class="image"
                            id="imgedit">
                    @else
                        @if ($teacher->getGender() == 'male')
                            <img src="{{ url('images/img_avatar.png') }}" alt="Person" class="image" id="imgedit">
                        @else
                            <img src="{{ url('images/img_avatar2.png') }}" alt="Person" class="image" id="imgedit">
                        @endif
                    @endif

                    <!-- imgEdit -->
                    <form action="{{ route('teacher.updateImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="input" name="proImage" onchange="readURL(this);" hidden>
                        <button type="submit" id="proImgSub" name="SubmitproImage" class="btn btn-primary mt-2"
                            hidden>Save</button>
                    </form>
                    <button id="proImgCan" class="btn btn-danger mt-2" hidden>Cancel</button>
                    <h3 class="mt-3 mb-3">{{ $teacher->getFname() }}</h3>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="profile">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">@lang('lang.full_name'):</th>
                                <td>{{ $teacher->getFname() . ' ' . $teacher->getLname() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.Email'):</th>
                                <td>{{ $teacher->getEmail() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.Gender'):</th>
                                <td>{{ $teacher->getGender() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.phone_number'):</th>
                                <td>{{ $teacher->getPhNumber() }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.Password'):</th>
                                <td>
                                        ********
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <button id="edit" name="edit" class="btn btn-info my-btn"><i
                            class="fas fa-user-edit"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="back-edit">
        <div class="edit">
            <i class="far fa-times-circle" id="exit" style="font-size: 30px; text-align: center; cursor: pointer;"></i>
            <h3 class="text-danger">@lang('lang.edit_my_data')</h3>
            <hr>
            <form action="{{ route('teacher.updateProfile') }}" method="POST">
                @csrf
                <table class="table-edit">
                    <tr>
                        <th><label for="fn">@lang('lang.first_name'):</label></th>
                        <td><input type="text" id="fn" name="fn" class="form-control"
                                value="{{ $teacher->getFname() }}" required></td>
                    </tr>
                    <tr>
                        <th> <label for="ln">@lang('lang.last_name'):</label></th>
                        <td><input type="text" id="ln" name="ln" class="form-control"
                                value="{{ $teacher->getLname() }}" required></td>
                    </tr>
                    <tr>
                        <th><label for="phone">@lang('lang.phone_number'):</label></th>
                        <td><input type="text" id="phone" name="phone" class="form-control"
                                value="{{ $teacher->getPhNumber() }}" required></td>
                    </tr>
                    <tr>
                        <th><label for="old">@lang('lang.Old_Password'):</label></th>
                        <td><input type="password" id="old" name="old" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th><label for="new">@lang('lang.New_Password'):</label></th>
                        <td><input type="password" id="new" name="new" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="@lang('lang.save')" name="save" id="save"
                                class="btn btn-info btn-block mt-4"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('myjs')
    {{-- navbar js --}}
    <script src="{{ url('js/student/s_navbar.js') }}"></script>
    <script src="{{ url('js/student/s_profile.js') }}"></script>
@endsection

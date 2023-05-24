@php
    if (session()->missing('type')) {
        return abort(401, 'Unauthorized');
    } else {
        if (session('type') != 'admin') {
            return abort(401, 'Unauthorized');
        }
    }
@endphp
@extends('layout')
@section('mycss')
    <link rel="stylesheet" href="{{ url('css/admin/a_information_profile.css') }}">
    <link rel="stylesheet" href="{{ url('css/student/s_profile.css') }}">
@endsection
@section('navbar')
    @include('admin.adminNavBar')
@endsection
@section('contant')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12 p-0">
                <div class="profile-img">
                    @if ($profile_teacher->T_img != '')
                        <img src="{{ url('upload/img/', $profile_teacher->T_img) }}" alt="Person" class="infoImage">
                    @else
                        @if ($profile_teacher->T_gender == 'male')
                            <img src="{{ url('images/img_avatar.png') }}" alt="Person" class="infoImage">
                        @else
                            <img src="{{ url('images/img_avatar2.png') }}" alt="Person" class="infoImage">
                        @endif
                    @endif
                    <h3 class="mt-3 mb-3">{{$profile_teacher->T_fname}}
                    </h3>
                    <p>@lang('lang.department:') {{$profile_teacher->D_name}}</p>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="profile mt-1">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">ID:</th>
                                <td>{{$profile_teacher->T_id}}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.first name')</th>
                                <td>{{$profile_teacher->T_fname}} {{$profile_teacher->T_lname}}
                                </td>
                            </tr>
                            <th scope="row">@lang('lang.gender'):</th>
                            <td>{{$profile_teacher->T_gender}}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.email'):</th>
                                <td>{{$profile_teacher->T_email}}</td>
                            </tr>

                            <tr>
                                <th scope="row">@lang('lang.phone_number'):</th>
                                <td>{{$profile_teacher->T_phNumber}}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.subject'):</th>
                                <td>{{$profile_teacher->S_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{route('admin.teacherView.delete',$profile_teacher->T_id)}}" class="btn btn-outline-danger btn-block mt-3 mb-4 w-100">@lang('lang.delete')</a>
            </div>
        </div>
    </div>
@endsection
@section('myjs')
    <script src="{{ url('js/admin/a_information_profile.js') }}"></script>
@endsection

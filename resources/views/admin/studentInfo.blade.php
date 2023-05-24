@php
    if (session()->missing('type')) {
        return abort(401, 'Unauthorized');
    } else {
        if (session('type') != 'admin' && session('type') != 'teacher') {
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
    @if (session('type') == 'teacher')
        @include('teacher.teacherNavBar')
    @elseif (session('type') == 'admin')
        @include('admin.adminNavBar')
    @endif
@endsection
@section('contant')
    @isset($error)
        @php
            return abort(401, 'Unauthorized');
        @endphp
    @endisset

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12 p-0">
                <div class="profile-img">
                    @if ($profile_student2->St_img != '')
                        <img src="{{ url('upload/img/' . $profile_student2->St_img) }}" alt="Person" class="infoImage">
                    @else
                        @if ($profile_student2->St_gender == 'male')
                            <img src="{{ url('images/studentAvatar1.jpg') }}" alt="Person" class="infoImage">
                        @else
                            <img src="{{ url('images/studentAvatar2.png') }}" alt="Person" class="infoImage">
                        @endif
                    @endif
                    <h3 class="mt-3 mb-3">{{ $profile_student2->St_fname }}</h3>
                    <p>@lang('lang.department:') {{ $profile_student2->D_name }}</p>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="profile mt-1">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">ID:</th>
                                <td>{{ $profile_student2->St_id }}</td>
                            </tr>
                            <tr>
                                <th scope="row"> @lang('lang.full_name'):</th>
                                <td>{{ $profile_student2->St_fname . ' ' . $profile_student2->St_lname }}</td>
                            </tr>
                            <th scope="row">@lang('lang.gender'):</th>
                            <td>{{ $profile_student2->St_gender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.email'):</th>
                                <td>{{ $profile_student2->St_email }}</td>
                            </tr>
                            <tr>
                                <th scope="row"> @lang('lang.phone_number'):</th>
                                <td>{{ $profile_student2->St_phNumber }}</td>
                            </tr>
                            <tr>
                                <th scope="row">@lang('lang.Date of birth:')</th>
                                <td>{{ $profile_student2->St_DOB }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (session('type') == 'admin')
                    <button id="show" class="btn btn-outline-info btn-block mt-3 mb-4"> @lang('lang.Show all comments')</button>
                @endif
            </div>
        </div>
    </div>
    @if (session('type') == 'admin')
        <div class="comments">
            <div class="cont">
                <div class="">
                    <i class="far fa-times-circle" id="exit"
                        style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                    <h2>All comments:</h2>
                    <hr>
                </div>
                <div id="allcomments">
                    <!-- ************* here write all comments and answers **************** -->
                    @foreach ($comments as $comment)
                        <div class="comment">
                            @if ($comment->St_img != null)
                                <img src="{{ url('upload/img/' . $comment->St_img) }}" alt="Person" class="comm-img">
                            @else
                                @if ($comment->St_gender == 'male')
                                    <img src="{{ url('images/studentAvatar1.jpg') }}" alt="Person" class="comm-img">
                                @else
                                    <img src="{{ url('images/studentAvatar2.png') }}" alt="Person" class="comm-img">
                                @endif
                            @endif
                            <div class="comm-cont">
                                <p class="comm-name">{{ $comment->St_fname . ' ' . $comment->St_lname }}</p>
                                <p class="comm-p">{{ $comment->C_comment }}</p>
                            </div>
                            @php
                                $answers = DB::table('comments')
                                    ->join('videos', 'comments.V_id', '=', 'videos.V_id')
                                    ->join('units', 'videos.U_id', '=', 'units.U_id')
                                    ->join('teachers', 'units.T_id', '=', 'teachers.T_id')
                                    ->join('answers', 'comments.C_id', '=', 'answers.C_id')
                                    ->where('comments.C_id', $comment->C_id)
                                    ->get();
                            @endphp
                            @foreach ($answers as $answer)
                                @if ($answer->C_id == $comment->C_id)
                                    <div class="answer">
                                        @if ($answer->T_img != null)
                                            <img src="{{ url('upload/img/' . $answer->T_img) }}" alt="Person"
                                                class="comm-img">
                                        @else
                                            @if ($answer->T_gender == 'male')
                                                <img src="{{ url('images/img_avatar.png') }}" alt="Person"
                                                    class="comm-img">
                                            @else
                                                <img src="{{ url('images/img_avatar2.png') }}" alt="Person"
                                                    class="comm-img">
                                            @endif
                                        @endif
                                        <div class="comm-cont">
                                            <p class="comm-name">{{ $answer->T_fname . ' ' . $answer->T_lname }}</p>
                                            <p class="comm-p">{{ $answer->A_answer }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


@endsection
@section('myjs')
    <script src="{{ url('js/admin/a_information_profile.js') }}"></script>
    @if (session('type') == 'teacher')
        <script src="{{ url('js/student/s_navbar.js') }}"></script>
    @endif
@endsection

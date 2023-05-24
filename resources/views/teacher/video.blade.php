@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_video.css') }}" rel="stylesheet">
    <link href="{{ url('css/teacher/t_video.css') }}" rel="stylesheet">
@endsection
@section('navbar')
    @include('teacher.teacherNavBar')
@endsection
@section('contant')
    @if (session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>!</strong> {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @php
            session()->forget('msg');
        @endphp
    @endif
    <div class="ml-5 mr-5 container-style">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="cont">
                    <iframe class="video" src="{{ $video->V_path }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div id="all-comments">
                    @foreach ($comments as $data)
                        @if ($data->is_blocked == 'not_blocked')
                            <div class="comment">
                                @if ($data->St_img != '')
                                    <img src="{{ url('upload/img', $data->St_img) }}" alt="Person" class="comm-img">
                                @else
                                    @if ($data->St_gender == 'male')
                                        <img src="{{ url('images/studentAvatar1.jpg') }}" alt="Person" class="comm-img">
                                    @else
                                        <img src="{{ url('images/studentAvatar2.png') }}" alt="Person" class="comm-img">
                                    @endif
                                @endif

                                <div class="comm-cont">
                                    <p class="comm-name">{{ $data->St_fname . ' ' . $data->St_lname }}</p>
                                    <p class="comm-p">{{ $data->C_comment }}</p>
                                </div>

                                <div class="action">
                                    <i class="far fa-comment-dots Pointer" id="{{$data->C_id}}" onclick="getid(this)"></i>

                                    <i class="fas fa-ellipsis-h" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.studentinfo.show', $data->St_id) }}">@lang('lang.profile')</a>

                                        <a class="dropdown-item"
                                            href="{{ route('teacher.video.comment.delete', $data->C_id) }}">@lang('lang.delete')</a>

                                        <form action="{{ route('teacher.video.blockuser') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="BlockID" value="{{ $data->St_id }}">
                                            <input type="hidden" name="comment" value="{{ $data->C_comment }}">
                                            <input type="submit" class="dropdown-item" value="@lang('lang.block')">
                                        </form>
                                    </div>
                                </div>

                                @php
                                    $answers = DB::table('answers')
                                        ->join('comments', 'answers.C_id', '=', 'comments.C_id')
                                        ->join('videos', 'comments.V_id', '=', 'videos.V_id')
                                        ->join('units', 'videos.U_id', '=', 'units.U_id')
                                        ->join('teachers', 'units.T_id', '=', 'teachers.T_id')
                                        ->where('answers.C_id', $data->C_id)
                                        ->select('answers.*', 'teachers.T_fname', 'teachers.T_lname', 'teachers.T_img', 'teachers.T_gender')
                                        ->get();
                                @endphp

                                @foreach ($answers as $data2)
                                    <div class="answer">
                                        @if ($data2->T_img != '')
                                            <img src="{{ url('upload/img', $data2->T_img) }}" alt="Person"
                                                class="comm-img">
                                        @else
                                            @if ($data2->T_gender == 'male')
                                                <img src="{{ url('images/img_avatar.png') }}" alt="Person"
                                                    class="comm-img">
                                            @else
                                                <img src="{{ url('images/img_avatar2.png') }}" alt="Person"
                                                    class="comm-img">
                                            @endif
                                        @endif
                                        <div class="comm-cont">
                                            <p class="comm-name">{{ $data2->T_fname . ' ' . $data2->T_lname }}</p>
                                            <p class="comm-p">{{ $data2->A_answer }}</p>
                                            <a href="{{route('teacher.video.deleteAnswer',$data2->A_id)}}" class="border-0 btn btn-outline-danger float-right" style="float:right;"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- Add answer -->
            <div class="back-new-comm">
                <div class="new-comm">
                    <i class="far fa-times-circle" id="exit"
                        style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                    <h2>@lang('lang.add_Answer')</h2>
                    <div style="text-align: center;">
                        <hr>
                        <form action="{{route('teacher.video.addanswer')}}" method="POST">
                            @csrf
                            <input type="hidden" name="cid" id="C_id" value="">
                            <textarea name="answerContent" id="new-comment" cols="65" rows="10"></textarea>
                            <button class="btn btn-info btn-block mt-4" type="submit">@lang('lang.add_Answer')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myjs')
    <script src="{{ url('js/student/s_navbar.js') }}"></script>
    <script src="{{ url('js/teacher/t_video.js') }}"></script>
@endsection

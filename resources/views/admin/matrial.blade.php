@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_material.css') }}" rel="stylesheet">
@endsection
@section('navbar')
    @include('admin.adminNavBar')
@endsection
@section('contant')
    <div>
        <div class="row ml-5 mr-5">
            <div class="col-12 col-sm-9">
                @if (!empty($units))
                    <section>
                        @foreach ($units as $data)
                            <div class="chapter">
                                <h4 class="s_h4">@lang('lang.chapter') {{ $data->U_number }}</h4>

                                @if ($data->V_id)
                                    <div class="video">
                                        <a class="btn" href="{{route('admin.video',$data->V_id) }}">
                                            <img src="{{ url('images/youtube-video.jpg') }}" class="pdfimg" alt="...">
                                            <span class="my-span">{{ $data->V_name }}</span>
                                        </a>
                                    </div>
                                @endif

                                @if ($data->M_path)
                                    <div class="pdf">
                                        <button class="btn">
                                            <img src="{{ url('images/pdf.png') }}" class="pdfimg" alt="PDF:">
                                            <a href="{{ url('upload/PDF/', $data->M_path) }}" download>
                                                <span class="my-span">{{ $data->M_name }}</span>
                                            </a>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </section>
                @else
                    <p class="display-4 mt-5"> @lang('lang.Choose Teacher') ...</p>
                @endif
            </div>
            <div class="col-3">
                <h4 class="m-5">@lang('lang.Teachers'): </h4>
                <nav class="rightSlide">
                    <ul>
                        @foreach ($teachersInSubject as $data)
                            <li>
                                @if ($data->T_img != '')
                                    <img src='../../upload/img/{{ $data->T_img }}' alt='Person' class='TIMG'>
                                @else
                                    @if ($data->T_gender == 'male')
                                        <img src='../../images/img_avatar.png' alt='Person' class='TIMG'>
                                    @else
                                        <img src='../../images/img_avatar2.png' alt='Person' class='TIMG'>
                                    @endif
                                @endif
                                <div class="cont">
                                    <a href="{{ route('admin.subjectView.subjectTeacherindex', ['Subjectid' => $data->S_id, 'teacherid' => $data->T_id]) }}"
                                        class="btn-block btn">{{ $data->T_fname . ' ' . $data->T_lname }}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </nav>
            </div>
        </div>
    </div>
@endsection

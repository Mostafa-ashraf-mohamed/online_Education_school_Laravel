@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_material.css') }}" rel="stylesheet">
    <link href="{{ url('css/teacher/t_material.css') }}" rel="stylesheet">
@endsection
@section('navbar')
    @include('teacher.teacherNavBar')
@endsection
@section('contant')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @foreach ($units as $unit)
                    <section>
                        <div class="chapter">
                            <div class="d-flex justify-content-between">
                                <h4 class="d-inline-block"> @lang('lang.chapter') {{ $unit->U_number }}</h4>
                                <a clase="btn" href="{{ route('teacher.material.delete.unit',$unit->U_id) }}"><i
                                        class="fas fa-times my-i"></i></a>
                            </div>

                            @foreach ($unit->videos as $video)
                                <div class="video">
                                    <a class="btn d-inline-block" href="{{route('teacher.video',$video->V_id)}}">
                                        <img src="{{url('images/youtube-video.jpg')}}" class="pdfimg" alt="video:">
                                        <span class="my-span">{{ $video->V_name }}</span>
                                    </a>


                                    <div class="dropdown text-right d-inline-block">
                                        <i class="fas fa-ellipsis-h my-i my-i2 pdfimg1" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('teacher.material.delete.video', $video->V_id) }}"
                                                class="dropdown-item">@lang('lang.remove') </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($unit->materials as $material)
                                <div class="pdf">
                                    <input type="hidden" name="path" value="{{ $material->M_path }}">
                                    <input type="hidden" name="namePDF" value="{{ $material->M_name }}">
                                    <button type="submit" class="btn">
                                        <img src="{{url('images/pdf.png')}}" class="pdfimg" alt="pdf:">
                                        <a href="{{url('upload/PDF',$material->M_path) }}" download>
                                            <span class="my-span">{{ $material->M_name }}</span>
                                        </a>
                                    </button>
                                    <div class="dropdown text-right d-inline-block">
                                        <i class="fas fa-ellipsis-h my-i my-i2 pdfimg1" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('teacher.material.delete.material', $material->M_id) }}"
                                                class="dropdown-item">@lang('lang.remove') </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button onclick="$(backGround).fadeIn('slow'); getid(this);" id="{{ $unit->U_id }}"
                                class="btn btn-outline-success add-m">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </section>
                @endforeach

                <!-- button -->
                <a href="{{ route('teacher.material.createChapter') }}" class="btn btn-outline-info w-100 mb-5 mt-3">
                    @lang('lang.add_Chapter')
                </a>
            </div>
        </div>
    </div>



    <!-- new material -->
    <div class="back-ground">
        <div class="cont">
            <div class="choose text-center">
                <div class="text-right">
                    <i class="far fa-times-circle" id="exit"
                        style="font-size: 30px; text-align: center; cursor: pointer;"></i>
                </div>
                <p class="text-danger text-center mt-4" style="font-size: 40px;">@lang('lang.add_Content')</p>
                <button class="btn btn-outline-success mr-5" id="btn-video">@lang('lang.video')</button>
                <button class="btn btn-outline-success" id="btn-file">@lang('lang.file')</button>
            </div>
        </div>
        <div class="cont video hidden" id="panel-video">
            <i class="fas fa-arrow-right float-right" id="arrow-video"></i>
            <div class="text-center">
                <form action="{{route('teacher.material.addvideo')}}" method="POST">
                    @csrf
                    <label for="link" class="text-center">@lang('lang.link youtube')</label>
                    <input type="text" name="link"
                        placeholder="youtube link example:https://www.youtube.com/embed/-gn2mo7t5hM"
                        class="form-control mt-2" id="link">
                    <label for="title" class="text-center">@lang('lang.title')</label>
                    <input type="text" name="title" placeholder="@lang('lang.video title')" class="form-control mt-2"
                        id="ttitle ">
                    <input type="hidden" class="U_id" name="Unit_id" value="">
                    <input type="submit" class="btn btn-primary w-50 mt-4" value="@lang('lang.upload')">
                </form>
            </div>
        </div>
        <div class="cont file hidden" id="panel-file">
            <div class="Fcontainer">
                <i class="fas fa-arrow-right float-right" id="arrow-file"></i>
                <h3 class="d-inline-block">@lang('lang.upload_your_File')</h3>
                <div class="drag-area">
                    <form action="{{ route('teacher.material.addmaterial') }}" class="text-center" method="POST"
                        enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        <div class="icon">
                            <i class="fas fa-file-pdf"></i><i class="mr-1 ml-1 fas fa-file-powerpoint"></i><i
                                class="fas fa-file-word"></i>
                        </div>
                        <span class="header"> @lang('lang.Drag & Drop')</span> <br>
                        <span class="header"> @lang('lang.or')<span class="button">@lang('lang.browse')</span> </span>
                        <br>
                        <span class="support">@lang('lang.Supports'): PDF,PPT,doc,rar,zip </span>
                        <div class="form-group">
                            <label for="PDFTitle" class="mt-3" style="font-size: 20px; font-weight: bold;">
                                @lang('lang.title')
                            </label>
                            <input type="text" class="form-control" name="PDFtitle" id="PDFTitle">
                        </div>
                        <input type="file" name="PDFfile" id="input" hidden>
                        <input type="hidden" class="U_id" name="Unit_idPDF" value="">
                        <input type="submit" class="btn btn-primary w-50 mt-4" value="@lang('lang.upload')">
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('myjs')
    {{-- navbar js --}}
    <script src="{{ url('js/student/s_navbar.js') }}"></script>
    <script src="{{ url('js/teacher/t_material.js') }}"></script>
@endsection

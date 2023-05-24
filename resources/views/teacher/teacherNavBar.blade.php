@php
    if (session()->has('locale')) {
        app()->setlocale(session('locale'));
    }
    if (session()->has('teacherData')) {
        $teacherData = session("teacherData");
    }else{
        return abort(401, 'Unauthorized');
    }
@endphp
{{-- css --}}
<link rel="stylesheet" href="{{ url('css/navbar.css') }}">
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ url('css/navAR.css') }}">
@endif
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="../../images/logo.jpeg" alt="school"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav" style="margin-left: auto;">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('teacher.material')}}">@lang('lang.material')</a>
            </li>
            <!-- dd -->
            <li class="nav-item" style="z-index: 1000000;">
                <button class="nav-link btn" id="bell"><i class="fas fa-bell"></i></button>
                <div class="notification" id="notification">
                    <div class="card card-body" id="card">
                        @php
                            $comments = DB::table('comments')
                                ->select('comments.*', 'students.*', 'videos.*', 'units.*')
                                ->join('students', 'comments.St_id', '=', 'students.St_id')
                                ->join('videos', 'comments.V_id', '=', 'videos.V_id')
                                ->join('units', 'videos.U_id', '=', 'units.U_id')
                                ->where('units.T_id', $teacherData->getId())
                                ->get();
                        @endphp


                        <!-- ************************************* -->
                        @foreach ($comments as $data)
                            @php
                                $answers = DB::table('answers')
                                    ->select('answers.*')
                                    ->join('comments', 'answers.C_id', '=', 'comments.C_id')
                                    ->where('answers.C_id', $data->C_id)
                                    ->get();
                            @endphp
                            @if (count($answers) == 0 && !(DB::table('blocks')->where('St_id',$data->St_id)->first()))
                                <div class="comment">
                                    <a href="{{route('teacher.video',$data->V_id)}}" style="text-decoration: none;">
                                        @if ($data->St_img != '')
                                            <img src="{{ url('upload/img/', $data->St_img) }}" alt="Person"
                                                class="comm-img">
                                        @else
                                            @if ($data->St_gender == 'male')
                                                <img src="{{ url('images/img_avatar.png') }}" alt="Person"
                                                    class="comm-img">
                                            @else
                                                <img src="{{ url('images/img_avatar2.png') }}" alt="Person"
                                                    class="comm-img">
                                            @endif
                                        @endif
                                        <div class="comm-cont">
                                            <p class="comm-name">{{$data->St_fname}} {{$data->St_lname}} </p>
                                            <p class="comm-p"> {{$data->C_comment}}</p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </li>
            <!-- ff -->
            <li class="nav-item dropdown " id="chipART">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <div class="chip">
                        @if ($teacherData->getImg() != '')
                            <img src="{{ url('upload/img/', $teacherData->getImg()) }}" alt="Person" width="96"
                                height="96">
                        @else
                            @if ($teacherData->getGender() == 'male')
                                <img src="{{ url('images/img_avatar.png') }}" alt="Person" width="96"
                                    height="96">
                            @else
                                <img src="{{ url('images/img_avatar2.png') }}" alt="Person" width="96"
                                    height="96">
                            @endif
                        @endif
                        {{ $teacherData->getFname() }}
                    </div>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('teacher.profile')}}">@lang('lang.Settings')</a>
                    @if (app()->getLocale() == 'en')
                        <a class="dropdown-item" href="{{ route('setLang', 'ar') }}">العربية</a>
                    @else
                        <a class="dropdown-item" href="{{ route('setLang', 'en') }}">English</a>
                    @endif

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">@lang('lang.log out')</a>
                </div>
            </li>
        </ul>
    </div>
</nav>



@php
    if(session()->has('locale')){
        app()->setlocale(session('locale'));
    }
@endphp
{{-- css --}}
<link rel="stylesheet" href="{{ url('css/navbar.css') }}">
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ url('css/navAR.css') }}">
@endif
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="../../images/logo.jpeg" alt="school logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" id="dashboard" href="{{ route('admin.dashboard') }}">@lang('lang.Home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tickets" href="{{ route('admin.tickets.index') }}">@lang('lang.tickets')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="students" href="{{ route('admin.studentView.index') }}">@lang('lang.Students')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="teachers" href="{{ route('admin.teacherView.index') }}">@lang('lang.Teachers')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="subjects" href="{{route('admin.subjectView.index')}}">@lang('lang.Subjects')</a>
            </li>
            <li class="nav-item dropdown" id="chipAR">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <div class="chip">
                        <img src="../../images/avataradmin.png" alt="Person" width="96" height="96">
                        Admin
                    </div>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('admin.setting')}}">@lang('lang.Settings')</a>
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

{{-- navbar js --}}
<script src="{{ url('js/navbar.js') }}"></script>

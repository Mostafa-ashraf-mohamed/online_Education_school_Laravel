@extends('layout')
@section('mycss')
    <link href="{{ url('css/student/s_home.css') }}" rel="stylesheet">
@endsection
@section('navbar')
    @include('admin.adminNavBar')
@endsection
@section('contant')
    <div class="container text-center">
        @if (session()->has('departments'))
            @foreach (session('departments') as $department)
                <h1 class="text-center text-primary display-3">{{ $department->D_name }}</h1>
                @foreach ($department->subjects as $subject)
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('admin.subjectView.subjectindex', $subject->S_id) }}" class="btn" style="padding: 0%; margin: 0%;">
                            <img src="{{ url('images/subject-default.jpg') }}" class="card-img-top" alt="subject-default">
                            <div class="card-body">
                                <p class="card-text">{{ $subject->S_name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
@endsection

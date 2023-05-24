@extends('layout')
@section('mycss')
    <link href="{{ url('css/admin/a_student.css') }}" rel="stylesheet">
@endsection

@section('navbar')
    @include('admin.adminNavBar')
@endsection

@section('contant')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">@lang('lang.image')</th>
                    <th scope="col">@lang('lang.full_name')</th>
                    <th scope="col">@lang('lang.Email')</th>
                    <th scope="col">@lang('lang.Phone')</th>
                    <th scope="col">@lang('lang.Gender')</th>
                    <th scope="col">@lang('lang.date of birth')</th>
                    <th scope="col">@lang('lang.department')</th>
                    <th scope="col">@lang('lang.Action')</th>
                </tr>
            </thead>
            <tbody>
                @if (session()->has('students'))
                    @foreach (session('students') as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                @if ($data->St_img != null)
                                    <img src="{{ url('upload/img/', $data->St_img) }}" alt="Person">
                                @else
                                    @if ($data->St_gender == 'male')
                                        <img src="{{ url('images/studentAvatar1.jpg') }}" alt="Person">
                                    @else
                                        <img src="{{ url('images/studentAvatar2.png') }}" alt="Person">
                                    @endif
                                @endif
                            </td>
                            <td>{{ $data->St_fname }} {{ $data->St_lname }}</td>
                            <td>{{ $data->St_email }}</td>
                            <td>0{{ $data->St_phNumber }}</td>
                            <td>{{ $data->St_gender }}</td>
                            <td>{{ $data->St_DOB }}</td>
                            <td>{{ $data->D_name }}</td>
                            <td>
                                <a href="{{ route('admin.studentView.delete', $data->St_id) }}"
                                    class="btn btn-danger">@lang('lang.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('myjs')
@endsection

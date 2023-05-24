@extends('layout')
@section('mycss')

@endsection
@section('navbar')
    @include('admin.adminNavBar')
@endsection
@section('contant')
    @if (session()->has('mgs'))
        <div class='alert alert-primary' role='alert'>Record update successfully</div>
        @php
            session()->forget('mgs');
        @endphp
    @endif
    @if (session()->has('error'))
        <div class='alert alert-danger' role='alert'>Error updating record</div>
        @php
           session()->forget('error');
        @endphp
    @endif
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">@lang('lang.Name')</th>
                    <th scope="col">@lang('lang.Email')</th>
                    <th scope="col">@lang('lang.Phone')</th>
                    <th scope="col">@lang('lang.Content')</th>
                    <th scope="col">@lang('lang.Action')</th>
                </tr>
            </thead>
            <tbody>
                @if (session()->has('tickets'))
                    @foreach (session('tickets') as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->St_fname }}</td>
                            <td>{{ $data->St_email }}</td>
                            <td>0{{ $data->St_phNumber }}</td>
                            <td>{{ $data->Ti_ticket }}</td>
                            <td>
                                @if ($data->Ti_status == 'open')
                                    <a href="{{ route('admin.tickets.update', $data->Ti_id) }}"  class="btn btn-success">@lang('lang.Close')</a>
                                @else
                                    @lang('lang.Closed')
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

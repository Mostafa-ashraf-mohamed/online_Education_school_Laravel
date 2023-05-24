@extends('layout')
@section('mycss')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
@endsection
@section('contant')
    @if (app()->getLocale() == 'en')
        <a class="btn text-light" href="{{route('home.login','ar')}}" style="position:absolute; top:0;right:0;"><i
                style="font-size:30px;" class="fas fa-language"></i></a>
    @else
        <a class="btn text-light" href="{{route('home.login','en')}}" style="position:absolute; top:0;right:0;"><i
                style="font-size:30px;" class="fas fa-language"></i></a>
    @endif

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        @isset($error)
            <div class='w-100 position-absolute' style='z-index:10000;'>
                <div class='alert alert-danger m-auto text-center' role='alert'>{{ $error }}</div>
            </div>
        @endisset
        @isset($createStates)
            @isset($massage)
                @if ($createStates)
                    <div class='w-100 position-absolute' style='z-index:10000;'>
                        <div class='alert alert-success m-auto text-center' role='alert'>{{ $massage }}</div>
                    </div>
                @else
                    <div class='w-100 position-absolute' style='z-index:10000;'>
                        <div class='alert alert-danger m-auto text-center' role='alert'>{{ $massage }}</div>
                    </div>
                @endif
            @endisset
        @endisset
        <div class="signup">
            <form action="{{ route('home.index') }}" method="POST">
                @csrf
                <label id='label' for="chk" aria-hidden="true">@lang('lang.login')</label>
                <input type="email" name="email" placeholder="@lang('lang.email')" required>
                <input type="password" name="password"placeholder="@lang('lang.password')" required>
                <button class="rounded-pill bg-light text-dark" type="submit">@lang('lang.login')</button>
            </form>
            <p class="text-center text-light">— @lang('lang.Or Sign In With') —</p>
            <div class="form-row">
                <button class="d-inline m-1 col-6 btn btn-primary"><i class="fa-brands fa-square-facebook "
                        style="font-size:35px; "></i></button><button class="d-inline m-1 col-6 btn btn-yallow"><i
                        class="fa-brands fa-google" style="font-size:30px; "></i></button>
            </div>


        </div>
        <div class="login create cont">
            <label for="chk" id='label' class="font-small" aria-hidden="true">@lang('lang.create account')</label>
            <div class="cont">
                <form action="{{ route('home.create') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-6 col-md-6 mb-3">
                            <input type="text" name="F_name" class="form-control is-invalid"
                                aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.first name')" required>
                        </div>
                        <div class="col-6 col-md-6 mb-3">
                            <input type="text" name="L_name" class="form-control is-invalid"
                                aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.last name')" required>
                        </div>
                    </div>
                    <input type="text" name="phonenumber" class="form-control is-invalid s1" maxlength="11"
                        aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.phone number')" required />
                    <input type="email" name="c_email" class="form-control is-invalid s1"
                        aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.email')" required>
                    <input type="password" name="c_password" class="form-control is-invalid s1"
                        aria-describedby="validatedInputGroupPrepend" placeholder="@lang('lang.password')" required>
                    <div class="form-row">
                        <label class="style-1 col-5">@lang('lang.Date of birth:')</label>
                        <input class="col-6" type="date" name="DOB" class="form-control is-invalid s2"
                            aria-describedby="validatedInputGroupPrepend">
                    </div>
                    <label class="style-2">@lang('lang.Gender:')</label>
                    <div class="div-1">
                        <label for="male" class="gender">@lang('lang.Male')</label>
                        <input type="radio" id="male" name="gender" value="male" class="radio" checked>
                    </div>
                    <div class="div-1">
                        <label for="female" class="gender">@lang('lang.Female')</label>
                        <input type="radio" id="female" name="gender" value="female" class="radio">
                    </div>
                    <select class="form-select" name="department" aria-label="Default select example">
                        <option selected value="department">@lang('lang.department:')</option>
                        @foreach ( $departments as $department)
                            <option value="{{ $department->D_id }}">{{ $department->D_name }}</option>
                        @endforeach
                    </select>
                    <input class="btn btn-success signup" type="submit" value="@lang('lang.Sign Up')">
                </form>
            </div>

        </div>
    </div>
    {{-- create error section --}}
    <div class="wrappernotifay

    @if(app()->getLocale() == 'en')
        ltrnotifay
    @else
        rtlnotifay
    @endif
    ">
        @isset($createerror)
            @if ($createerror['nameerr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">feild required</span>
                            <span class="notifications__item__message"><strong>first and Last name</strong> must be for letter
                                only only.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['phone_numbererr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">phone number</span>
                            <span class="notifications__item__message"><strong><strong>accept</strong> number
                                    only and must be 11 number.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['c_emailerr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">email address</span>
                            <span class="notifications__item__message">enter valid email address</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['c_passworderr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">weak password</span>
                            <span class="notifications__item__message"><strong>password</strong> has to be at least one number
                                and at least one letter
                                and it has to be a number, a letter or one of the following: !@#$%
                                and there have to be 8-12 characters.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['DOBerr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content ">
                            <span class="notifications__item__title">date of birth</span>
                            <span class="notifications__item__message">Must be in form of date.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['gendereerr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">gender</span>
                            <span class="notifications__item__message">dont forget this.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
        @isset($createerror)
            @if ($createerror['departmenteerr'])
                <div class="notifications">
                    <div class="notifications__item">
                        <div class="notifications__item__content">
                            <span class="notifications__item__title">department</span>
                            <span class="notifications__item__message">dont forget this.</span>
                        </div>
                        <div>
                            <div class="notifications__item__option delete js-option">
                                <i class="fa-solid fa-trash fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
    </div>



@endsection
@section('myjs')
<script src="{{url('js/login.js')}}"></script>
@endsection

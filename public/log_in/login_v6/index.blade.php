@extends('login_view::index_type_1')
@section('loginContent')
    <body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{$background_image}}');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form"  action="{{$action}}" method="post">
                    @csrf
                    <div class="login100-form-avatar">
                        <img src="{{$website_logo}}" alt="logo">
                    </div>

                    <span class="login100-form-title p-b-45">
						{{$website_name}}
					</span>
                    <span class="login100-form-title p-t-20 p-b-45">
						@lang('auth.login')
					</span>

                    @include('admin.errors.validation-message')

                    <div class="wrap-input100 validate-input m-b-10 {{ $errors->has('username') ? ' is-invalid' : '' }}" data-validate="{{__('auth.Username is required')}}">
                        <input class="input100" type="text" name="username" placeholder="{{__('auth.username')}}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input m-b-10 {{ $errors->has('password') ? ' is-invalid' : '' }}" data-validate="{{__('auth.password is required')}}">
                        <input class="input100" type="password" name="password" placeholder="{{__('auth.password')}}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn">
                            @lang('auth.login')
                        </button>
                    </div>

                    <div class="text-center w-full p-t-25 p-b-230">
                        <a href="#" class="txt1">
                            {{--Forgot Username / Password?--}}
                        </a>
                    </div>

                    <div class="text-center w-full">
                        <a class="txt1" href="#">
                            {{--Create new account--}}
                            {{--<i class="fa fa-long-arrow-right"></i>--}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </body>
@endsection
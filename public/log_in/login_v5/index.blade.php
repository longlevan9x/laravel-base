@extends('login_view::index_type_1')
@section('loginContent')
    <body>
    <link rel="stylesheet" type="text/css" href="{{asset("log_in/fonts/iconic/css/material-design-iconic-font.min.css")}}">


    <div class="container-login100" style="background-image: url('{{$background_image}}');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <div class="row">
                <div class="col-xs-6 col-md-4" style="margin: 0 auto">
                    <a href="#" class="thumbnail">
                        <img class="img-responsive" style="width: 100%;" src="{{\App\Commons\Facade\CFile::getImageUrl('settings', setting(KEY_LOGO))}}" alt="">
                    </a>
                </div>
                <div class="col-md-12 text-center">
                    <h2 class="" style="color: #00a0d2">{{setting(KEY_WEBSITE_NAME, config('app.name'))}}</h2>
                </div>
            </div>
            <br>
            <form class="login100-form validate-form" action="{{$action}}" method="post">
                @csrf
				<span class="login100-form-title p-b-37">
					{{$login_title}}
				</span>

                @include('admin.errors.validation-message')

                <div class="wrap-input100 validate-input m-b-20 {{ $errors->has('username') ? ' is-invalid' : '' }}" data-validate="{{__('auth.Username is required')}}">
                    <input class="input100" type="text" name="username" placeholder="{{__('auth.username')}}">
                    <span class="focus-input100"></span>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input100 validate-input m-b-25 {{ $errors->has('password') ? ' is-invalid' : '' }}" data-validate="{{__('auth.password is required')}}">
                    <input class="input100" type="password" name="password" placeholder="{{__('auth.password')}}">
                    <span class="focus-input100"></span>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        @lang('auth.login')
                    </button>
                </div>

                <div class="text-center p-t-57 p-b-20">
					<span class="txt1">
						{{--Or login with--}}
					</span>
                </div>

                {{--<div class="flex-c p-b-112">--}}
                    {{--<a href="#" class="login100-social-item">--}}
                        {{--<i class="fa fa-facebook-f"></i>--}}
                    {{--</a>--}}

                    {{--<a href="#" class="login100-social-item">--}}
                        {{--<img src="images/icons/icon-google.png" alt="GOOGLE">--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="text-center">--}}
                    {{--<a href="#" class="txt2 hov1">--}}
{{--                        @lang('auth.login')--}}
                    {{--</a>--}}
                {{--</div>--}}
            </form>
        </div>
    </div>
    <div id="dropDownSelect1"></div>

    </body>
@endsection
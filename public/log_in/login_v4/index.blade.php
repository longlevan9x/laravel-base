@extends('login_view::index_type_1')
@section('loginContent')
    <body style="background-color: #999999;">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->


    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('{{$background_image}}');"></div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail">
                            <img class="img-responsive" style="width: 100%;" src="{{\App\Commons\Facade\CFile::getImageUrl('settings', setting(KEY_LOGO))}}" alt="">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <h2 class="" style="color: #00a0d2">{{setting(KEY_WEBSITE_NAME, config('app.name'))}}</h2>
                    </div>
                </div>
                <br><br>
                <form class="login100-form validate-form" action="{{$action}}" method="post">
                    @csrf
					<span class="login100-form-title p-b-59 text-center">
						{{$login_title}}
					</span>

                    @include('admin.errors.validation-message')

                    <div class="wrap-input100 validate-input {{ $errors->has('email') ? ' is-invalid' : '' }}" data-validate="{{__('auth.username is required')}}">
                        <span class="label-input100">@lang('auth.username')</span>
                        <input class="input100" type="text" name="username" placeholder="@lang('auth.username')" title="{{__('auth.enter your username')}}">
                        <span class="focus-input100"></span>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input {{ $errors->has('password') ? ' is-invalid' : '' }}" data-validate="{{__('auth.password is required')}}">
                        <span class="label-input100">{{__('auth.password')}}</span>
                        <input class="input100" type="text" name="password" placeholder="*************" title="{{__('auth.enter your password')}}">
                        <span class="focus-input100"></span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                {{__('auth.login')}}
                            </button>
                        </div>

                        <a href="#" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                            {{--Sign in--}}
                            {{--<i class="fa fa-long-arrow-right m-l-5"></i>--}}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('log_in/vendor/animsition/js/animsition.min.js')}}"></script>

    <script src="{{asset('log_in/vendor/select2/select2.min.js')}}"></script>

    <script src="{{asset('log_in/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('log_in/vendor/daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{asset('log_in/vendor/countdowntime/countdowntime.js')}}"></script>

    <script src="{{asset('log_in/login_'.$version.'/js/main.js')}}"></script>

    </body>
@endsection
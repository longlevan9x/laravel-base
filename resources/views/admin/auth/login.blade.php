<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{config('app.name')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset_login('images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset_login('login_v18/css/main.css')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="post" action="{{route(\App\Http\Controllers\Admin\AdminAuth\LoginController::getAdminRouteName('login'))}}">
					<span class="login100-form-title p-b-43">
						{{__('Login to continue')}}
					</span>

                @include('admin.errors.validation-message')

                <div id="txtUsername" class="wrap-input100 validate-input {{ $errors->has('email') ? ' is-invalid' : '' }}" data-validate="{{__('Username is required')}}">
                    <input class="input100" type="text" id="" name="username" autofocus value="{{old('username')}}" title="{{__('Enter your username')}}" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">{{__('Username')}}</span>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input100 validate-input {{ $errors->has('password') ? ' is-invalid' : '' }}" data-validate="{{__('Password is required')}}">
                    <input class="input100" type="password" name="password" title="{{__('Enter your password')}}" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">{{__('Password')}}</span>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                        <label class="label-checkbox100" for="ckb1">
                            {{__('Remember me')}}
                        </label>
                    </div>
                </div>

                @csrf

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        {{__('Login')}}
                    </button>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('{{asset_login("login_v18/images/bg-01.jpg")}}');">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset_login('login_v18/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/animsition/js/animsition.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/bootstrap/js/popper.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/vendor/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset_login('login_v18/js/main.js')}}"></script>
</body>
</html>

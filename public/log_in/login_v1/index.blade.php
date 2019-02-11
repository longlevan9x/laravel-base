@extends('login_view::index_type_1')
@section('loginContent')
    <body>
    <style type="text/css">
        .container-login100 {
            background: url('{{$background_image}}') !important;
        }
    </style>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <h2>{{$website_name}}</h2>
                    <img src="{{$website_logo}}" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="{{$action}}" method="post">
                    @csrf
                    <span class="login100-form-title">{{$login_title}}</span>

                    @include('admin.errors.validation-message')

                    <div id="txtUsername" class="wrap-input100 validate-input {{ $errors->has('email') ? ' is-invalid' : '' }}" data-validate="{{__('auth.Username is required')}}">
                        <input class="input100" type="text" id="username" autofocus value="{{old('username')}}" name="username" placeholder="{{__('auth.username')}}" title="{{__('auth.enter your username')}}" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-envelope" aria-hidden="true"></i></span>

                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="{{__('auth.password is required')}}">
                        <input class="input100" type="password" name="password" title="{{__('auth.enter your password')}}" required placeholder="{{__('auth.password')}}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{__('auth.login')}}
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        {{--<span class="txt1">--}}
                        {{--Forgot--}}
                        {{--</span>--}}
                        {{--<a class="txt2" href="#">--}}
                        {{--Username / Password?--}}
                        {{--</a>--}}
                    </div>

                    <div class="text-center p-t-136">
                        {{--<a class="txt2" href="#">--}}
                        {{--<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>--}}
                        {{--</a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset("log_in/vendor/select2/select2.min.js")}}"></script>
    <script src="{{asset("log_in/vendor/tilt/tilt.jquery.min.js")}}"></script>
    <script>
        $(".js-tilt").tilt({
            scale: 1.1
        });
    </script>

    </body>
@endsection
@extends('login_view::index_type_1')
@section('loginContent')
    <body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" action="{{route(\App\Http\Controllers\Admin\AdminAuth\LoginController::getAdminRouteName('login'))}}">
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
                    <span class="login100-form-title p-b-43">
                        {{__('auth.login to continue')}}
                    </span>

                    @include('admin.errors.validation-message')

                    <div id="txtUsername" class="wrap-input100 validate-input {{ $errors->has('email') ? ' is-invalid' : '' }}" data-validate="{{__('auth.Username is required')}}">
                        <input class="input100" type="text" id="" name="username" autofocus value="{{old('username')}}" title="{{__('auth.enter your username')}}" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">{{__('auth.username')}}</span>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input {{ $errors->has('password') ? ' is-invalid' : '' }}" data-validate="{{__('auth.password is required')}}">
                        <input class="input100" type="password" name="password" title="{{__('auth.enter your password')}}" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">{{__('auth.password')}}</span>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            {{--<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">--}}
                            {{--<label class="label-checkbox100" for="ckb1">--}}
{{--                                {{__('auth.remember me')}}--}}
                            {{--</label>--}}
                        </div>
                    </div>

                    @csrf

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{__('auth.login')}}
                        </button>
                    </div>
                </form>

                <div class="login100-more" style="background-image: url('{{$background_image}}');">
                </div>
            </div>
        </div>
    </div>

    </body>
@endsection
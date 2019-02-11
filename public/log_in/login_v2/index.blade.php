<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$website_name}} | {{$website_description}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="icon" type="image/png" href="{{$website_logo}}" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('log_in/login_v2/css/style.css')}}">
    <style type="text/css">
        .cont {
            position: relative;
            height: 100%;
            background-image: url("{{$background_image}}") !important;
            background-size: cover;
            overflow: auto;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body>

<div class="cont">
    <div class="demo">
        <div class="login">
            <div class="login__check"></div>
            <div class="login__form">
                <form class="login100-form validate-form" action="{{$action}}" method="post">
                    @csrf

                    @if (isset($errors) && count($errors))
                        <ul style="font-size: 3em;color: azure;">
                            @foreach ($errors->all() as $error)
                                <li style="list-style-type: none">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                        </svg>
                        <input type="text" class="login__input name" autofocus value="{{old('username')}}" placeholder="@lang('auth.username')" name="username" />
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                        </svg>
                        <input type="password" class="login__input pass" placeholder="@lang('auth.password')" name="password" />
                    </div>
                    <button type="submit" class="login__submit">@lang('auth.login')</button>
                    {{--<p class="login__signup">Don't have an account? &nbsp;<a>Sign up</a></p>--}}
                </form>
            </div>
        </div>
    </div>
</div>
<script src='{{asset('log_in/vendor/jquery/jquery-3.2.1.min.js')}}'></script>

<script src="{{asset('log_in/login_v2/js/index.js')}}"></script>

</body>

</html>

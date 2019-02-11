<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$website_name}} | {{$website_description}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{$website_logo}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('log_in/login_' . $version . '/css/main.css')}}">

    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <script type="text/javascript" src="{{asset('log_in/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('log_in/vendor/bootstrap/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{asset('log_in/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
@yield('loginContent')
<script type="text/javascript" src="{{asset('log_in/login_' . $version . '/js/main.js')}}"></script>

</html>
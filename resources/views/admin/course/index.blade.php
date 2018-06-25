@extends('admin.index')
@section('content')
    @include('admin.course._form', compact('model'))
    {{--Table--}}
    @include('admin.course.list', compact('models'))
@endsection
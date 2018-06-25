@extends('admin.index')
@section('content')
    @include('admin.schedule._form', compact('model'))
    {{--Table--}}
    @include('admin.schedule.list', compact('models'))
@endsection
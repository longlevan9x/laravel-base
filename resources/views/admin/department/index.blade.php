@extends('admin.index')
@section('content')
    @include('admin.department._form', compact('model'))
    {{--Table--}}
    @include('admin.department.list', compact('models'))
@endsection
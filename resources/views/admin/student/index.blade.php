@extends('admin.index')
@section('content')
    @include('admin.student._form', compact('model'))
    {{--Table--}}
    @include('admin.student.list', compact('models'))
@endsection
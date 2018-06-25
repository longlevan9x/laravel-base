@extends('admin.index')
@section('content')
    @include('admin.semester._form', compact('model'))
    {{--Table--}}
    @include('admin.semester.list', compact('models'))
@endsection
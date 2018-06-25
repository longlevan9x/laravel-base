@extends('admin.index')
@section('content')
    @include('admin.area._form', compact('model'))
    {{--Table--}}
    @include('admin.area.list', compact('models'))
@endsection
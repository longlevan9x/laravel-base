@extends('admin.index')
@section('content')
    @include('admin.schedule-exam._form', compact('model'))
    {{--Table--}}
    @include('admin.schedule-exam.list', compact('models'))
@endsection
@extends('admin.index')
@section('content')
    {{--Table--}}
    @include('admin.sync-history.list', compact('models'))
@endsection
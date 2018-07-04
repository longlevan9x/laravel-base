@extends('admin.index')
@section('content')
    @include('admin.admin.list', compact('models'))
@endsection
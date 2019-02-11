@extends('admin.index')
@section('content')
    @include('admin.user.list', compact('models'))
@endsection
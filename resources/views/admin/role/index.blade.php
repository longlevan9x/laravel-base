@extends('admin.index')
@section('content')
    @include('admin.role.list', compact('models'))
@endsection
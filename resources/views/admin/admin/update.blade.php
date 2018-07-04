@extends('admin.index')
@section('content')
    @include('admin.admin._form', compact('model'));
@endsection
@extends('admin.index')
@section('content')
    @include('admin.user._form', compact('model'));
@endsection
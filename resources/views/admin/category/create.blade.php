@extends('admin.index')
@section('content')
    @include('admin.category._form', compact('model'))
@endsection
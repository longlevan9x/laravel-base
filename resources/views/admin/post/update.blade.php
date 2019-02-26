@extends('admin.index')
@section('content')
    @include('admin.post._form', compact('model'));
@endsection
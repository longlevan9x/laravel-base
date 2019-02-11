@extends('admin.index')
@section('content')
    @include('admin.role._form', compact('model'));
@endsection
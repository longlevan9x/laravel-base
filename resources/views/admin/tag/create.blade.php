@extends('admin.index')
@section('content')
    @include('admin.tag._form', compact('model'))
@endsection
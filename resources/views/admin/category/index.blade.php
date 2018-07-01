@extends('admin.index')
@section('content')
    @include('admin.category.list', compact('models'))
@endsection
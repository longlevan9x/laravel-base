@extends('admin.index')
@section('content')
    @if((request()->route()->getActionMethod() == 'edit' && can_edit('tag')) || (request()->route()->getActionMethod() == 'index' && can_create('tag')))
        <div class="col-md-4">
            @include('admin.tag._form', compact('model'));
        </div>
    @endif
    <div class="col-md-8">
        @include('admin.tag.list', compact('models'))
    </div>
@endsection
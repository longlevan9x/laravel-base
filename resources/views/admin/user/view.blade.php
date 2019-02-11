<?php
/** @var \App\Models\Admins $model */
?>
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <td>@lang('ID')</td>
            <td>{{$model->id}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.author')</td>
            <td>{{$model->getAuthorName()}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.name')</td>
            <td>{{$model->name}}</td>
        </tr>
        <tr>
            <td>@lang('auth.username')</td>
            <td>{{$model->username}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.email')</td>
            <td>{{$model->email}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.label.is.active')</td>
            <td>{!! $model->getIsActiveLabel() !!}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.gender')</td>
            <td>{!! $model->getGenderLabel()  !!}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.phone number')</td>
            <td>{{$model->phone}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.address')</td>
            <td>{{$model->address}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.image')</td>
            <td><img src="{{ $model->getImageUrl()}}" alt="" width="200px" height="200px"></td>
        </tr>
        <tr>
            <td>@lang('auth.last_login')</td>
            <td>{{$model->last_login}}</td>
        </tr>
        <tr>
            <td>@lang('auth.last_logout')</td>
            <td>{{$model->last_logout}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.created date')</td>
            <td>{{$model->created_at}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.updated date')</td>
            <td>{{$model->updated_at}}</td>
        </tr>
    </table>
    @can(ability_edit('user'))
        <div class="pull-left">
            @include('admin.layouts.widget.button.button_link.edit', ['url' => \App\Http\Controllers\Admin\UserController::getConfigUrlAdmin($model->id, 'edit'), 'text' => __('abilities.title.update')])
        </div>
    @endcan
    @can(ability_destroy('user'))
        {{Form::open([
	        'url' => \App\Http\Controllers\Admin\UserController::getUrlAdmin($model->id),
            'method' => 'delete'
        ])}}
        @include('admin.layouts.widget.button.button_link.delete', ['url' => \App\Http\Controllers\Admin\UserController::getUrlAdmin($model->id), 'text' => __('abilities.title.destroy')])
        {{Form::close()}}
    @endcan
</div>

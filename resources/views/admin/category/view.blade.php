<?php
/** @var \App\Models\Category $model */
?>
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <td>ID</td>
            <td>{{$model->id}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.image')</td>
            <td><img src="{{ $model->getImageUrl()}}" alt="" width="200px" height="200px"></td>
        </tr>
        <tr>
            <td>@lang('admin/common.name')</td>
            <td>{{$model->name}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.label.is.active')</td>
            <td>{!! $model->getIsActiveLabel() !!}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.seo_title')</td>
            <td>{{$model->seo_title}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.seo_keyword')</td>
            <td>{{$model->seo_keyword}}</td>
        </tr>
        <tr>
            <td>@lang('admin/common.seo_description')</td>
            <td>{{$model->seo_description}}</td>
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
    @can(ability_edit('category'))
        <div class="pull-left">
            @include('admin.layouts.widget.button.button_link.edit', ['url' => \App\Http\Controllers\Admin\CategoryController::getConfigUrlAdmin($model->id, 'edit'), 'text' => __('abilities.title.update')])
        </div>
    @endcan
    @can(ability_destroy('category'))
        {{Form::open([
	        'url' => \App\Http\Controllers\Admin\CategoryController::getUrlAdmin($model->id),
            'method' => 'delete'
        ])}}
        @include('admin.layouts.widget.button.button_link.delete', ['url' => \App\Http\Controllers\Admin\CategoryController::getUrlAdmin($model->id), 'text' => __('abilities.title.destroy')])
        {{Form::close()}}
    @endcan
</div>

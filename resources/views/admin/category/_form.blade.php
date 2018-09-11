<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 10:56 PM
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            @include('admin.layouts.title_form', ['title' => __('admin/category.add category')])
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\CategoryController::getUrlAdmin(isset($model) ? $model->id : ''),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model)
                ]) }}
                {{--<div class="form-group">--}}
                    {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id"> {{__('admin/category.parent')}}</label>--}}
                    {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                        {{--{!! Form::select('parent_id', \App\Models\Category::pluckWithCategory('name', 'id'), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'parent_id']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('admin.information_general')</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('admin/category.name')<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('name', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">@lang('admin/category.slug')</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('slug', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'slug']) !!}
                            <p class="help-block">@lang('admin/category.will be automatically generated from your title, if left empty.')</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_active" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('admin/common.is_active')</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="">
                                <label>
                                    {!! Form::hidden('is_active', $value = 0) !!}
                                    {!! Form::checkbox('is_active', $value = 1,$value = null, ['class' => 'js-switch']) !!}
                                </label>
                            </div>
                        </div>
                    </div>
                    @include('admin.layouts.widget.form.image-col-6', ['model' => $model ?? null])
                </div>
                <div class="col-md-4">
                    {{--Seo--}}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('admin.seo')</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="seo_title">@lang('admin/common.seo_title')</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::text('seo_title', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'rows' => 2, 'id' => 'seo_title']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="seo_keyword">@lang('admin/common.seo_keyword')</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::text('seo_keyword', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'rows' => 2, 'id' => 'seo_keyword']) !!}
                        </div>
                    </div>
                    {{--Seo--}}
                </div>
                <div class="clearfix"></div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        @include('admin.layouts.widget.button.button-action-form', ['url' => url_admin('category')])
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

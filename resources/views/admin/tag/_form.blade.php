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
            <div class="x_content">
                {{ Form::model(get_model($model), [
                    'url' => \App\Http\Controllers\Admin\TagController::getUrlAdminWithModel($model),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model),
                ]) }}
                <div class="form-group">
                    <label class="col-md-12 col-sm-12 col-xs-12" for="name">@lang('admin/common.name')</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! Form::text('name', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12 col-sm-12 col-xs-12" for="slug">@lang('admin/category.slug')</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! Form::text('slug', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'slug']) !!}
                        <p class="help-block">@lang('admin/category.will be automatically generated from your title, if left empty.')</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 col-sm-12 col-xs-12" for="description">@lang('admin/common.description')</label>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        {!! Form::textarea('description', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'description', 'rows' => 4]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12">@lang('admin/common.is_active')</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="">
                            <label>
                                {!! Form::hidden('is_active', $value = 0) !!}
                                {!! Form::checkbox('is_active', $value = 1,$value = null, ['class' => 'js-switch']) !!}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                        <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i>&nbsp;@lang('admin.resetButton')</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

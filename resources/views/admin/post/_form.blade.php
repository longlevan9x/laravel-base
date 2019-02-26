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
            @include('admin.layouts.title_form', ['title' => __('admin/post.add post')])
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\PostController::getUrlAdmin(isset($model) ? $model->id : ''),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model)
                ]) }}
                {{Form::hidden('type', $value = ($type ?? null))}}
                <div class="col-md-9 row">
                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="title">@lang('admin/common.title')<span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::text('title', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'title']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-12 col-sm-12 col-xs-12" for="editor">@lang('admin/news.content')</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::textarea('content', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'editor1']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" col-md-12 col-sm-12 col-xs-12" for="overview">@lang('admin/common.overview')</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::textarea('overview', $value = null,['rows' => 4, 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'overview']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="slug">@lang('admin/category.slug')</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::text('slug', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'slug']) !!}
                            <p class="help-block">@lang('admin/category.will be automatically generated from your title, if left empty.')</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    @include('admin.layouts.widget.form.checkbox', ['field' => 'is_active'])
                    @include('admin.layouts.widget.form.checkbox', ['field' => 'is_comment'])

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="category_id"> {{__('admin/menu.category')}}</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::select('category_id', \App\Models\Category::whereType($type)->myPluck('name', 'id', __('admin.category')), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'category_id']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-sm-12 col-xs-12" for="post_time"> {{__('admin/news.publish date')}}</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <div class="col-md-12" style="padding-right: 0">
                                {!! Form::text('post_time', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'default' => '', 'id' => 'post_time']) !!}
                            </div>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    @include('admin.layouts.widget.form.image-full', ['model' => $model ?? null])
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                            <button class="btn btn-primary" type="reset"><i class="fa fa-refresh"></i>&nbsp;@lang('admin.resetButton')</button>
                            @include('admin.layouts.widget.button.button_link.button', ['text' => __('admin.backButton'), 'icon' => 'fa-mail-reply', 'btn_type' => 'default', 'url' => url_admin('post'), 'btn_size' => 'md'])
                        </div>
                    </div>

                    @include('admin.layouts.templates.tags.tag', ['type' => 'post'])
                    {{--Seo--}}
                    <br>
                    @include('admin.layouts.templates.seo._form')
                    {{--Seo--}}

                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

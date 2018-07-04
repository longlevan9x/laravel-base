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
            @include('admin.layouts.title_form', ['title' => "Form Depertment"])
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\CategoryController::getUrlAdmin(isset($model) ? $model->id : ''),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => isset($model) ? 'put' : 'post'
                ]) }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id"> {{__('Parent')}}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('parent_id', \App\Models\Category::pluckWithCategory('name', 'id'), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'parent_id']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('name', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">@lang('admin/category.slug')</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('slug', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'slug']) !!}
                        <p class="help-block">Will be automatically generated from your title, if left empty.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_active" class="control-label col-md-3 col-sm-3 col-xs-12">Is active</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="">
                            <label>
                                {!! Form::hidden('is_active', $value = 0) !!}
                                {!! Form::checkbox('is_active', $value = 1,$value = null, ['class' => 'js-switch']) !!}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">{{__('Image')}}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*', 'class' => '', 'aria-describedby'=>"fileHelp"]) !!}
                    </div>
                </div>

                @push('scriptString')
                    <script>
                        let configFileinput = {
                            dropZoneEnabled:      false,
                            showUpload:           false,
                            initialPreviewAsData: true,
                            initialPreviewConfig: [
                                {caption: "logo.png"}
                            ]
                        };
                        let segment         = `{{request()->segment(3)}}`;
                        if (!isNaN(segment)) {
                            configFileinput.dropZoneEnabled = true;
                            configFileinput.initialPreview = "{{isset($model) ?  $model->getImagePath() : ""}}";
                        }
                        console.log(configFileinput);
                        $("#image").fileinput(configFileinput);

                    </script>
                @endpush
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">@lang('admin.submitButton')</button>
                        <button class="btn btn-primary" type="reset">@lang('admin.resetButton')</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

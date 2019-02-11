@extends('admin.index')
@section('content')
	<?php

	?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.layouts.title_form', ['title' => __('admin/menu.add_news')])
                <div class="x_content">
                    {{ Form::model(isset($model) ? $model : null, [
                        'url' => \App\Http\Controllers\Admin\WebsiteController::getUrlAdmin('message'),
                        'files' => true,
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'demo-form2',
                        'data-parsley-validate',
                    ]) }}
                    @method('post')
                    <div class="col-md-12 row">
                        <div class="col-md-6">
                            @include('admin.layouts.widget.form.editor', ['height' => 200, 'name' => '_message_order', 'label' => __('admin.notification message order')])
                        </div>
                        <div class="col-md-6">
                            @include('admin.layouts.widget.form.editor', ['height' => 200, 'name' => '_message_order_success', 'label' => __('admin.notification message order success')])
                        </div>
                        <div class="col-md-6">
                            @include('admin.layouts.widget.form.editor', ['height' => 200, 'name' => '_message_order_fail', 'label' => __('admin.notification message order fail')])
                        </div>
                        <div class="clearfix"></div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                            </div>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('admin.index')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="x_panel">
                @include('admin.layouts.title_table', ['text' => __('admin/menu.setting')])
                <div class="x_content">
                    {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\SettingController::getUrlAdmin(),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model)
                ]) }}
                    @method('post')
                    {{--General--}}
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('admin.information_general')</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lang_default">@lang('admin/setting.lang_default')
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {!! Form::select('lang_default', config('common.language.locales'),$value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'lang_default']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="format_date">@lang('admin/setting.format_date')
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {!! Form::select('format_date', ['Y-m-d' => __('admin/setting.Year-Month-Day'), "d-m-Y" => __('admin/setting.Day-Month-Year')], $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'format_date']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="format_datetime">@lang('admin/setting.format_datetime')
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {!! Form::select('format_datetime', ['Y-m-d H:i' => __('admin/setting.Year-Month-Day Hour:Minutes'), "d-m-Y H:i:s" => __("admin/setting.Day-Month-Year Hour:Minutes:Second")], $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'format_datetime']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="format_time">@lang('admin/setting.format_time')
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        {!! Form::select('format_time', ['H:i' => __('admin/setting.Hour:Minutes'), "H:i:s" => __('admin/setting.Hour:Minutes:Second')],$value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'format_time']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--General--}}
                    {{--Login--}}
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('auth.login')</h3>
                            </div>
                            <div class="panel-body">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="{{config('common.settings.keys._v_login')}}">@lang('admin/setting.login_version')
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {!! Form::select(config('common.settings.keys._v_login'), config('common.settings.login_versions'),$value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => config('common.settings.keys._v_login')]) !!}
                                </div>
                                @include('admin.layouts.widget.form.image-full', ['name' => config('common.settings.keys._background_login'), 'imagePath' => isset($model) ? $model->getImagePathWithoutDefault('', config('common.settings.keys._background_login')) : '', 'label' => __('admin/setting.background_image')])
                            </div>
                        </div>
                    </div>
                    {{--Login--}}

                    <div class="clearfix"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            @include('admin.layouts.widget.button.button-action-form', ['url' => url_admin('setting')])
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
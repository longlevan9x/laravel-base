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
            @include('admin.layouts.title_form', ['title' => __('admin/menu.add user')])
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\AdminController::getUrlAdmin(isset($model) ? $model->id : ''),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model)
                ]) }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">@lang('auth.username')
                        <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('username', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'username']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">@lang('auth.password') @if(!isset($model))
                            <span class="required">*</span> @endif</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
                        @if(isset($model) && !empty($model))
                            <p class="help-inline">{{__('auth.blank textbox. if you not change password')}}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('admin/common.name')*</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('name', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('Email')*</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::email('email', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role"> {{__('admin/user.role')}}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('role', \App\Models\Admins::getCollectionRoles(), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'role']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">@lang('admin/common.phone')</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('phone', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'phone']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">@lang('admin/common.address')</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('address', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'address']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('admin/common.is_active')</label>
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">{{__('admin/common.gender')}}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12 btn-group" id="gender" data-toggle="buttons">
                        <label class="btn btn-default {{\App\Commons\Facade\CUser::userAdmin()->gender == 1 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            {{ Form::radio('gender', $value = 1, \App\Commons\Facade\CUser::userAdmin()->gender == 1 ? ['checked'] : '') }} {{__('admin.male')}}
                        </label>
                        <label class="btn btn-info {{\App\Commons\Facade\CUser::userAdmin()->gender == 2 ? 'active' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-danger">
                            {{ Form::radio('gender', $value = 2, \App\Commons\Facade\CUser::userAdmin()->gender == 2 ? ['checked'] : '' ) }} {{__('admin.female')}}
                        </label>
                    </div>
                </div>
                @include('admin.layouts.widget.form.image-col-6', ['model' => $model ?? null])
                <div class="ln_solid"></div>
                @include('admin.layouts.widget.button.button-action-form', ['url' => url_admin('admin')])
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@extends('admin.index')
@section('content')
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
                @include('admin.layouts.title_form', ['title' => __('admin/setting.setting website')])
                <div class="x_content">
                    {{ Form::model(isset($model) ? $model : null, [
                        'url' => \App\Http\Controllers\Admin\WebsiteController::getUrlAdmin('config'),
                        'files' => true,
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'demo-form2',
                        'data-parsley-validate',
                    ]) }}
                    @method('post')
                    <div class="col-md-8 row">
                        <div class="row">
                            {{--Name && description--}}
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_name">@lang('admin/setting.website_name'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('website_name', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_name']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_description">@lang('admin/setting.website_description'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('website_description', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_description']) !!}
                                    </div>
                                </div>
                            </div>

                            {{--Phone--}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_phone">@lang('admin/common.phone'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::number('website_phone', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_phone']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_hotline">@lang('admin.hotline'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::number('website_hotline', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_hotline']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_fax">@lang('admin.fax'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::number('website_fax', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_fax']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_telephone">@lang('admin/website.telephone number'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::number('website_telephone', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_telephone']) !!}
                                    </div>
                                </div>
                            </div>
                            {{--Phone--}}

                            {{--Address && copyright--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="admin_email">@lang('admin/setting.admin_email'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('admin_email', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'admin_email']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_copyright">@lang('admin/common.copyright'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('website_copyright', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_copyright']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="website_address">@lang('admin/common.address'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('website_address', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_address']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_city">@lang('admin/common.city'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_city', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_city']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_district">@lang('admin/common.district'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_district', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_district']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_street">@lang('admin/common.streetAddress'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_street', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_street']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_postal_code">@lang('admin/common.postalCode'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_postal_code', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_postal_code']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_lat">@lang('admin/common.latitude'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_lat', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_lat']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="company_long">@lang('admin/common.longitude'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('company_long', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'company_long']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12" for="_google_map_link">@lang('admin/common.link google map'):</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        {!! Form::text('_google_map_link', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_google_map_link']) !!}
                                    </div>
                                </div>
                            </div>
                            {{--Address && copyright--}}

                            {{--Logo && Image--}}
                            <div class="col-md-6">
                                @include('admin.layouts.widget.form.image-full', ['name' => 'logo', 'imagePath' => isset($model) ? $model->getImagePathWithoutDefault('', 'logo') : '', 'label' => __('admin/setting.logo')])
                            </div>
                            <div class="col-md-6">
                                @include('admin.layouts.widget.form.image-full', ['name' => 'website_image', 'imagePath' => isset($model) ? $model->getImagePathWithoutDefault('', 'website_image') : '', 'label' => __('admin/setting.website_image')])
                            </div>
                            {{--Logo && Image--}}
                            {{--Slogan--}}
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">@lang('Slogan')</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12" for="website_slogan_link_post">@lang('Link to post'):</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    {!! Form::text('website_slogan_link_post', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_slogan_link_post']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12" for="website_slogan">@lang('Slogan'):</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    {!! Form::textarea('website_slogan', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'editor1', 'height' => 100]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--Slogan--}}
                            {{--Slogan--}}
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><h3>@lang('repositories.who_we_are')</h3></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12" for="website_slogan1_link_post">@lang('Link to post'):</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    {!! Form::text('website_slogan1_link_post', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_slogan1_link_post']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12" for="website_slogan1_title">@lang('admin/common.title'):</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    {!! Form::text('website_slogan1_title', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'website_slogan1_title']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        @include('admin.layouts.widget.form.editor', ['name' => 'website_slogan1_description', 'height' => 100, 'label' => __('admin/common.description')])
                                    </div>
                                </div>
                            </div>
                            {{--Slogan--}}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 row">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                            </div>
                        </div>
                        <br>
                        {{--Seo--}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('SEO')</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="seo_title">@lang('admin/common.seo_title'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('seo_title', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'seo_title']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="seo_keyword">@lang('admin/setting.seo_keyword'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('seo_keyword', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'seo_keyword']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="seo_description">@lang('admin/setting.seo_description'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::textarea('seo_description', $value = null,['rows' => 5, 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'seo_description']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{--Seo--}}
                        {{--Social--}}

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('admin.social')</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_skype">@lang('Skype'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_skype', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_skype']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_facebook">@lang('Facebook'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_facebook', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_facebook']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_youtube">@lang('Youtube'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_youtube', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_youtube']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_google_plus">@lang('Google Plus'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_google_plus', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_google_plus']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_whatsapp">@lang('Whatsapp'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_whatsapp', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_whatsapp']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_twitter">@lang('Twitter'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_twitter', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_twitter']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_social_instagram">@lang('Instagram'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_social_instagram', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_social_instagram']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{--Social--}}
                        {{--Scripts--}}

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('Scripts')</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_google_adwords_id">@lang('Google AdWords ID'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_google_adwords_id', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_google_adwords_id']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_google_adwords_src">@lang('Google Adwords Src'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_google_adwords_src', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_google_adwords_src']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_google_analytics_id">@lang('Google Analytics ID'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_google_analytics_id', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_google_analytics_id']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_vchat_hash">@lang('Vchat Hash'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_vchat_hash', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_vchat_hash']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12" for="_vchat_data">@lang('Vchat Data'):</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {!! Form::text('_vchat_data', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => '_vchat_data']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Scripts--}}

                    <div class="clearfix"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
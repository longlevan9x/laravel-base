{{--Seo--}}
<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">@lang('admin.seo')</h3>
    </div>
</div>
<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="seo_title">@lang('admin/common.seo_title')</label>
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::textarea('seo_title', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'rows' => 2, 'id' => 'seo_title']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="seo_keyword">@lang('admin/common.seo_keyword')</label>
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::textarea('seo_keyword', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'rows' => 2, 'id' => 'seo_keyword']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="seo_description">@lang('admin/common.seo_description')</label>
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::textarea('seo_description', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'seo_description']) !!}
    </div>
</div>
{{--Seo--}}
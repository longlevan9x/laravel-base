@php
    $label = $label ?? __('admin/common.label.is.'. str_replace("is_", '', $field));
    $col = $col ?? 8;
@endphp
<div class="form-group">
    <label class="col-md-{{12 - $col}} col-sm-{{12 - $col}} col-xs-12">{{$label}}</label>
    <div class="col-md-{{$col}} col-sm-{{$col}} col-xs-12">
        <div class="">
            <label>
                {!! Form::hidden($field, $value = 0) !!}
                {!! Form::checkbox($field, $value = 1,$value = null, ['class' => 'js-switch']) !!}
            </label>
        </div>
    </div>
</div>
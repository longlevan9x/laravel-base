@php
    $url_cancel = !isset($url_cancel) ? $url : $url_cancel;
@endphp
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        @include('admin.layouts.widget.button.button', ['type' => 'submit', 'text' => trans('admin.submitButton'), 'btn_type' => 'success'])
        @include('admin.layouts.widget.button.button', ['type' => 'reset', 'text' => trans('admin.resetButton'), 'btn_type' => 'primary'])
        @include('admin.layouts.widget.button.button_link.button', ['text' => trans('admin.cancelButton'), 'btn_type' => 'default', 'url' => $url_cancel])
    </div>
</div>
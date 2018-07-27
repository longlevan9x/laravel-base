@php
    $url_cancel = !isset($url_cancel) ? $url : $url_cancel;
@endphp
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        @include('admin.layouts.widget.button.button', ['type' => 'submit', 'text' => __('admin.saveButton'), 'icon' => 'fa-save','btn_type' => 'success', 'btn_size' => 'md'])
        @include('admin.layouts.widget.button.button', ['type' => 'reset', 'text' => __('admin.resetButton'), 'icon' => 'fa-refresh', 'btn_type' => 'primary', 'btn_size' => 'md'])
        @include('admin.layouts.widget.button.button_link.button', ['text' => __('admin.backButton'), 'icon' => 'fa-mail-reply', 'btn_type' => 'default', 'url' => $url_cancel, 'btn_size' => 'md'])
    </div>
</div>
{{Form::open([
	'url' => $url,
    'method' => 'put'
])}}
@include('admin.layouts.widget.button.button', ['icon' => $icon ?? 'fa-check-circle-o', 'url' => $url, 'btn_type' => $btn_type ?? 'danger', 'text' => $text ?? __('admin.confirm'), 'options' => $options ?? ['onclick' => "return confirmMessage($(this));", 'data-modal-title'=> __('admin.confirm')]])
{{Form::close()}}
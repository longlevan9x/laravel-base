@php
    $options = $options ?? [];
    $options = array_merge($options, ['onclick' => "return confirmDelete($(this));", 'data-modal-title'=> __('admin.Are you sure delete this item')]);
@endphp
{{Form::open([
	'url' => $url,
    'method' => 'delete'
])}}
@include('admin.layouts.widget.button.button', ['icon' => $icon ?? 'fa-remove', 'url' => $url, 'btn_type' => $btn_type ?? 'danger', 'text' => $text ?? __('admin.delete'), 'options' => $options ])
{{Form::close()}}
@php
    $showEdit   = !isset($showEdit) ? true : $showEdit;
    $showView   = !isset($showView) ? true : $showView;
    $showDelete = !isset($showDelete) ? true : $showDelete;
    $url_edit   = !isset($url_edit) ? $url . "/edit" : $url_edit;
    $url_view   = !isset($url_view) ? $url : $url_view;
    $url_delete = !isset($url_delete) ? $url : $url_delete;
@endphp
{{Form::open([
	'url' => $url,
    'method' => 'delete'
])}}
@if($showEdit)
    @include('admin.layouts.widget.button.button_link.edit', ['icon' => $icon_edit ?? 'fa-edit', 'url' => $url_edit, 'btn_type' => $btn_type_edit ?? 'default', 'text' => $text_edit ?? '', 'options' => $option_edit ?? []])
@endif
@if($showView)
    @include('admin.layouts.widget.button.button_link.view', ['icon' => $icon_view ?? 'fa-eye', 'url' => $url_view, 'btn_type' => $btn_type_view ?? 'info', 'text' => $text_view ?? '', 'options' => $option_view ?? []])
@endif
@if($showDelete)
    @include('admin.layouts.widget.button.button_link.delete', ['icon' => $icon_delete ?? 'fa-remove', 'url' => $url_delete, 'btn_type' => $btn_type_delete ?? 'danger', 'text' => $text_delete ?? '', 'options' => $option_delete ?? []])
@endif
{{Form::close()}}
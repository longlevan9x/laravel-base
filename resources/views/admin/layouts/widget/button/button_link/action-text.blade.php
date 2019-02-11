@php
    $showEdit   = !isset($showEdit) ? true : $showEdit;
    $showView   = !isset($showView) ? true : $showView;
    $showDelete = !isset($showDelete) ? true : $showDelete;
    $url_edit   = !isset($url_edit) ? $url . "/edit" : $url_edit;
    $url_delete = !isset($url_delete) ? $url : $url_delete;
@endphp
{{Form::open([
	'url' => $url,
    'method' => 'delete'
])}}
@if($showEdit)
    <div class="col-md-12 text-center">
        @include('admin.layouts.widget.button.button_link.edit', ['icon' => $icon_edit ?? 'fa-edit', 'url' => $url_edit, 'btn_type' => $btn_type_edit ?? 'default', 'text' => $text_edit ?? __('admin.edit'), 'options' => $option_edit ?? []])
    </div>
@endif
@if($showView)
    @php
        $option_view = $option_view ?? [];
        $viewAjax = $viewAjax ?? true;
        if ($viewAjax) {
            $url_view = $url_view ?? '';
            $option_view['role'] = "modal-view";
            /**
            * @var string $controller_name
            * render from
            * @see \App\Providers\AppServiceProvider line 80*/
            // neu url_view rong thi lay url mac dinh
            $url_view = empty($url_view) ? url_admin('ajax/view', [$model->id, $controller_name, base64_encode(get_class($model))]) : $url_view;
        }
        else {
            $url_view   = !isset($url_view) ? $url : $url_view;
        }
    @endphp
    <div class="col-md-12 text-center">
        @include('admin.layouts.widget.button.button_link.view', ['icon' => $icon_view ?? 'fa-eye', 'url' => $url_view, 'btn_type' => $btn_type_view ?? 'info', 'text' => $text_view ?? __('admin.view'), 'options' => $option_view])
    </div>
@endif
@if($showDelete)
    <div class="col-md-12 text-center">
        @include('admin.layouts.widget.button.button_link.delete', ['icon' => $icon_delete ?? 'fa-remove', 'url' => $url_delete, 'btn_type' => $btn_type_delete ?? 'danger', 'text' => $text_delete ?? __('admin.delete'), 'options' => $option_delete ?? []])
    </div>
@endif
{{Form::close()}}
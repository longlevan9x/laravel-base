@include('admin.layouts.widget.button.button', ['icon' => $icon ?? 'fa-remove', 'url' => $url, 'btn_type' => $btn_type ?? 'danger', 'text' => $text ?? __('admin.delete'), 'options' => ['data-modal-title'=> __('admin.Are you sure delete this item'), 'role' => 'modal-delete']])


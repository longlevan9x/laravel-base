@include('admin.layouts.widget.button.button', ['icon' => $icon ?? 'fa-remove', 'url' => $url, 'btn_type' => $btn_type ?? 'danger', 'text' => $text ?? __('admin.delete'), 'options' => ['onclick' => "return confirmDelete($(this));", 'data-modal-title'=> __('admin.Are you sure delete this item')]])


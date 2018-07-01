<div class="box-header with-border">
    @include('admin.layouts.widget.button.button_link.button', ['icon' => $icon ?? 'fa-edit', 'url' => $url, 'btn_type' => $btn ?? 'primary', 'text' => $text ?? '', 'option' => $option ?? []])
    <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
</div>
@if($slot == '1')
    @include('admin.layouts.widget.labels.info', ['text' => __('admin/common.active')])
@else
    @include('admin.layouts.widget.labels.warning', ['text' => __('admin/common.inactive')])
@endif
@if($slot == '1')
    @include('admin.layouts.widget.labels.info', ['text' => 'Active'])
@else
    @include('admin.layouts.widget.labels.warning', ['text' => 'Inactive'])
@endif
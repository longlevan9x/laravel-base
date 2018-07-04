@foreach($models as $key => $model)
    @include('admin.layouts.widget.options.select', ['value' => $key, 'text' => $model])
@endforeach
@php
    $value = $value ?? 0;
    if ($value == 0) {
        if (isset($model) && !empty($model)) {
            $value = $model->id;
        }
    }
@endphp

<input type="checkbox" class="check-one" name="table_records[]" value="{{$value}}">

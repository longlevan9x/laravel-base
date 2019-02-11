<?php
/** @var \Illuminate\Database\Eloquent\Model|\App\Models\Traits\ModelTrait $model */
$attributes = $model->getAttributes();
?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        @foreach($attributes as $column => $value)
            <tr>
                <th>{{$column}}</th>
                @if(in_array($column, ['image', 'banner']))
                    <td>{!! $model->showImage($column) !!}</td>
                @else
                    <td>{!! $value !!}</td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
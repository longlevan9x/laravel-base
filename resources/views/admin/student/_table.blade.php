<tr>
    <td><input type="checkbox"></td>
    <td>{{$model->code}}</td>
    <td>{{$model->name}}</td>
    <td>{{$model->class}}</td>
    <td>{{$model->branch}}</td>
    <td>
        @if($model->status == 'Đang học')
            @include('admin.layouts.widget.labels.info', ['text' => $model->status])
        @else
            @include('admin.layouts.widget.labels.default', ['text' => $model->status])
        @endif
    </td>
    <td>{{$model->day_admission}}</td>
    <td>{{$model->school_year}}</td>
    <td>{{$model->course}}</td>
    <td>
        @if($model->gender == 'Nam')
            @include('admin.layouts.widget.labels.success', ['text' => $model->gender])
        @else
            @include('admin.layouts.widget.labels.default', ['text' => $model->gender])
        @endif
    </td>
    <td>{{$model->type_education}}</td>
    <td>{{$model->getArea->name}}</td>
    <td>{{$model->average_cumulative}}</td>
    <td>{{$model->total_term}}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
        <a href="{{url('admin/department', [$model->id, 'edit'])}}" class="btn btn-sm btn-primary"><i
                    class='fa fa-edit'></i></a>
        <a class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
    </td>
</tr>
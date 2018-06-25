<tr>
    <td class="a-center ">
        <input type="checkbox" class="check-one" name="table_records">
    </td>
    {{--<td class="a-center "><input type="checkbox" name="table_records"></td>--}}
    <td>{{$model->code}}</td>
    <td>{{$model->name}}</td>
    <td>{{$model->total_student}}</td>
    <td>{{$model->department->name}}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">@component('admin.layouts.widget.labels.active'){{$model->is_active}} @endcomponent</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
        <a href="{{\App\Http\Controllers\Admin\CourseController::getEditUrlAdmin($model->id)}}"
           class="btn btn-sm btn-primary"><i class='fa fa-edit'></i></a>
        <a class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
    </td>
</tr>
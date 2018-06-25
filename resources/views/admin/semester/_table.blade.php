<tr>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 "><input type="checkbox" class="check-one" name="rows[{{$model->id}}]"></td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">{{$model->name}}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">@component('admin.layouts.widget.labels.active'){{$model->is_active}} @endcomponent</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
        <a href="{{url('admin/semester', [$model->id, 'edit'])}}"
           class="btn btn-sm btn-primary"><i class='fa fa-edit'></i></a>
        <button class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
    </td>
</tr>
<tr>
    <td><input type="checkbox"></td>
    <td>{{$model->name}}</td>
    <td>{{$model->type}}</td>
    <td>{{$model->total_record}}</td>
    <td>{{$model->status}}</td>
    <td>{{$model->created_at}}</td>
    <td>{{$model->updated_at}}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
        <a href="{{\App\Http\Controllers\Admin\SyncHistoryController::getEditUrlAdmin($model->id)}}" class="btn btn-sm btn-primary"><i class='fa fa-edit'></i></a>
        <a class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>
    </td>
</tr>
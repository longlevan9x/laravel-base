@php /** @var App\Models\Traits\ModelTrait|\Illuminate\Database\Eloquent\Model|\App\Models\Post $model*/ @endphp
<tr>
    <td class="a-center vertical-middle ">
        @include('admin.layouts.widget.table.input-check-one')
    </td>
    {{--<td class="a-center "><input type="checkbox" name="table_records"></td>--}}
    <td class="vertical-middle col-md-1">{!! $model->showImage('image') !!}</td>
    <td class="vertical-middle">{!! $model->getLinkSlugAndId() !!}</td>
    <td class="vertical-middle">{{$model->getAuthorName()}}</td>
    <td class="vertical-middle">{{$model->getCategoryName()}}</td>
    <td class="vertical-middle col-lg-1 col-md-1 col-sm-1 col-xs-1 ">{!! $model->getIsActiveLabel()  !!}</td>
    <td class="vertical-middle">{{$model->post_time}}</td>
    <td class="vertical-middle">{{$model->created_at}}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 vertical-middle">
        @include('admin.layouts.widget.button.button_link.action-text', ['url' => \App\Http\Controllers\Admin\PostController::getUrlAdmin($model->id), 'showEdit' => can_edit('post'), 'showDelete' => can_destroy('post'), 'showView' => can_show('post')])
    </td>
</tr>
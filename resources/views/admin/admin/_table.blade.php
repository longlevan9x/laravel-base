@php /** @var App\Models\Traits\ModelTrait|\Illuminate\Database\Eloquent\Model|\App\Models\Post $model*/ @endphp
<tr class="text-center">
    <td class="a-center vertical-middle ">
        @include('admin.layouts.widget.table.input-check-one')
    </td>
    {{--<td class="a-center "><input type="checkbox" name="table_records"></td>--}}
    <td class="vertical-middle">{!! $model->showImage('image')!!}</td>
    <td class="vertical-middle">{{$model->getAuthorUsername()}}</td>
    <td class="vertical-middle">{{$model->name}}</td>
    <td class="vertical-middle">{{$model->username}}</td>
    <td class="vertical-middle">{{$model->email}}</td>
    <td class="vertical-middle">{{$model->phone}}</td>
    <td class="vertical-middle">{{$model->getRoleText()}}</td>
    <td class="vertical-middle text-center">{!! $model->getGenderLabel() !!}</td>
    <td class="vertical-middle col-lg-1 col-md-1 col-sm-1 col-xs-1 ">@component('admin.layouts.widget.labels.active'){{$model->is_active}} @endcomponent</td>
    <td class="vertical-middle">{{$model->address}}</td>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 vertical-middle">
        @include('admin.layouts.widget.button.button_link.action', ['url' => \App\Http\Controllers\Admin\AdminController::getUrlAdmin($model->id),])
    </td>
</tr>
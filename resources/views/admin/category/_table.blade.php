@php /** @var App\Models\Traits\ModelTrait|\Illuminate\Database\Eloquent\Model|\App\Models\Category $model*/ @endphp
<tr>
    <td class="a-center vertical-middle ">
        @include('admin.layouts.widget.table.input-check-one')
    </td>
    {{--<td class="a-center "><input type="checkbox" name="table_records"></td>--}}
    <td class="vertical-middle">{!! $model->showImage('image')!!}</td>
{{--    <td class="vertical-middle">{{$model->getParentName()}}</td>--}}
    <td class="vertical-middle">{!! $model->getLinkSlug() !!}</td>
    <td class="vertical-middle">{{$model->slug}}</td>
    <td class="vertical-middle col-lg-1 col-md-1 col-sm-1 col-xs-1 ">@component('admin.layouts.widget.labels.active'){{$model->is_active}} @endcomponent</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 vertical-middle">
        @include('admin.layouts.widget.button.button_link.action-text', ['url' => \App\Http\Controllers\Admin\CategoryController::getUrlAdmin($model->id),])
    </td>
</tr>
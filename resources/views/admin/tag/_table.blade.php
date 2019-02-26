@php /** @var App\Models\Tag $model*/ @endphp
<tr>
    <td class="a-center vertical-middle ">
        @include('admin.layouts.widget.table.input-check-one')
    </td>
    <td class="vertical-middle">{!! $model->name !!}</td>
    <td class="vertical-middle">{!! $model->description !!}</td>
    <td class="vertical-middle">{!! $model->type !!}</td>
    <td class="vertical-middle col-lg-1 col-md-1 col-sm-1 col-xs-1 ">{!! $model->getIsActiveLabel() !!}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 vertical-middle">
        @include('admin.layouts.widget.button.button_link.action-text', ['url' => \App\Http\Controllers\Admin\TagController::getUrlAdmin($model->id), 'showEdit' => can_edit('tag'), 'showDelete' => can_destroy('tag')])
    </td>
</tr>
@php /** @var \Silber\Bouncer\Database\Role $model*/ @endphp
<tr>
    <td class="vertical-middle">{!! $model->title !!}</td>
    <td class="vertical-middle">
        {!! $model->abilities->pluck('name')->map(function ($item) {
            $parts = explode('-', $item);
            return '<span class="label label-primary">' . __("abilities.title." . $parts[1]) . "-" . __("abilities." .$parts[0]. ".name"). '</span>';
        })->implode(' ') !!}</td>
    <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 vertical-middle">
        @can(ability_edit('role'))
            <div class="col-md-12 text-center">
                @include('admin.layouts.widget.button.button_link.edit', ['url' => \App\Http\Controllers\Admin\RoleController::getConfigUrlAdmin($model->id, 'edit')])
            </div>
        @endcan
        @can(ability_destroy('role'))
            <div class="col-md-12 text-center">
                @include('admin.layouts.widget.button.button_link.delete', ['url' => \App\Http\Controllers\Admin\RoleController::getUrlAdmin($model->id)])
            </div>
        @endcan
    </td>
</tr>
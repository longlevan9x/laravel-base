<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => __('admin/menu.list slide')])
            <div class="box-header with-border">
                @can(ability_create('role'))
                    <div style="float: left;">
                        @include('admin.layouts.widget.button.button_link.create', ['text' => __('admin/common.add'), 'btn_size' => 'md', 'icon' => 'fa-plus', 'options' => ['data-style'=>"zoom-in", 'class' => 'ladda-button'], 'url' => route(\App\Http\Controllers\Admin\RoleController::getAdminRouteName('create'))])
                    </div>
                @endcan
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table {{(new \Silber\Bouncer\Database\Role)->getTable()}} table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th>@lang('admin/common.name')</th>
                            <th>@lang('admin/common.abilities')</th>
                            <th>@lang('admin/common.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.role._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

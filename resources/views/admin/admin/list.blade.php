<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => __('admin/menu.list user')])
            <div class="box-header with-border">
                <div style="float: left;">
                    @include('admin.layouts.widget.button.button_link.create', ['text' => __("admin/menu.add user"), 'btn_size' => 'md', 'icon' => 'fa-plus', 'options' => ['data-style'=>"zoom-in", 'class' => 'ladda-button'], 'url' => route(\App\Http\Controllers\Admin\AdminController::getAdminRouteName('create'))])
                </div>
                @include('admin.layouts.widget.button.bulk-delete', ['table' => \App\Models\Admins::table(), 'classTable' => \App\Models\Admins::class])
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table {{\App\Models\Admins::table()}} table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center vertical-middle">
                                <input type="checkbox" id="check-all" class="">
                            </th>
                            <th class="col-md-1 text-center vertical-middle">@lang('admin/common.image')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.user create')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.name')</th>
                            <th class="text-center vertical-middle">@lang('auth.username')</th>
                            <th class="text-center vertical-middle">@lang('Email')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.phone')</th>
                            <th class="text-center vertical-middle">@lang('admin/user.role')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.gender')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.is_active')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.address')</th>
                            <th class="text-center vertical-middle">@lang('admin/common.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.admin._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

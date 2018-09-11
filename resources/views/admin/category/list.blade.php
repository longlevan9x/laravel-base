<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => __('admin/category.list category')])
            <div class="box-header with-border">
                <div style="float: left;">
                    @include('admin.layouts.widget.button.button_link.create', ['text' => __("admin/category.add category"), 'btn_size' => 'md', 'icon' => 'fa-plus', 'options' => ['data-style'=>"zoom-in", 'class' => 'ladda-button'], 'url' => route(\App\Http\Controllers\Admin\CategoryController::getAdminRouteName('create'))])
                </div>
                @include('admin.layouts.widget.button.bulk-delete', ['table' => \App\Models\Category::table(), 'classTable' => \App\Models\Category::class])
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive" id="table-category">
                    <table id="datatable-checkbox" class="table {{\App\Models\Category::table()}} table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check-all" class="">
                            </th>
                            <th class="col-md-1">@lang('admin/common.image')</th>
{{--                            <th>@lang('admin/category.parent')</th>--}}
                            <th>@lang('admin/common.name')</th>
                            <th>@lang('admin/category.slug')</th>
                            <th>@lang('admin/common.is_active')</th>
                            <th>@lang('admin/common.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.category._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

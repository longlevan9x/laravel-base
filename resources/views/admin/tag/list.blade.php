<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => __('admin/menu.list slide')])
            <div class="box-header with-border">
                <div style="float: left;">
                    @include('admin.layouts.widget.button.bulk-delete', ['table' => \App\Models\Tag::table(), 'classTable' => \App\Models\Tag::class])
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table {{\App\Models\Tag::table()}} table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th class="vertical-middle col-lg-1 col-md-1 col-sm-1 col-xs-1 ">
                                <input type="checkbox" id="check-all" class="">
                            </th>
                            <th>@lang('admin/common.name')</th>
                            <th>@lang('admin/common.description')</th>
                            <th>@lang('admin/category.type')</th>
                            <th>@lang('admin/common.is_active')</th>
                            <th>@lang('admin/common.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.tag._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

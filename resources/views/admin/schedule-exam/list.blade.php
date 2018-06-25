<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => 'List department'])
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Test Day</th>
                            <th>Examination</th>
                            <th>Room</th>
                            <th>Type</th>
                            <th class="col-md-2 col-xs-2 col-lg-2 col-sm-2">Note</th>
                            <th>Is Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.schedule-exam._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

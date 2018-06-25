
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => 'List Semester'])
            <div class="x_content">
                @include('admin.semester._form_sync', compact('model'))
                <div class="clearfix"></div>
                <br>
                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="check-all"></th>
                        <th>Name</th>
                        <th>Is Active</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @each('admin.semester._table', $models, 'model', 'admin.layouts.widget.list-empty')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
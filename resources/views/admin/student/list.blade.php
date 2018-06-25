<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => 'List Student'])
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Day Admission</th>
                            <th>School Year</th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th>Type Education</th>
                            <th>Area</th>
                            <th>Average Cumulative</th>
                            <th>Total Term</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.student._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => 'List department'])
            @include('admin.layouts.widget.button.button_link.create', ['text' => __("Add User"), 'btn_size' => 'md', 'icon' => 'fa-plus', 'options' => ['data-style'=>"zoom-in", 'class' => 'ladda-button'], 'url' => route(\App\Http\Controllers\Admin\AdminController::getAdminRouteName('create'))])
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="text-center">
                            <th class="text-center vertical-middle">
                                <input type="checkbox" id="check-all" class="">
                            </th>
                            <th class="col-md-1 text-center vertical-middle">Image</th>
                            <th class="text-center vertical-middle">Author</th>
                            <th class="text-center vertical-middle">Name</th>
                            <th class="text-center vertical-middle">Username</th>
                            <th class="text-center vertical-middle">Email</th>
                            <th class="text-center vertical-middle">Phone</th>
                            <th class="text-center vertical-middle">Role</th>
                            <th class="text-center vertical-middle">Gender</th>
                            <th class="text-center vertical-middle">Is Active</th>
                            <th class="text-center vertical-middle">Address</th>
                            <th class="text-center vertical-middle">Action</th>
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

<?php
/** @var \Illuminate\Support\Collection $models */
/** @var \App\Models\Post $model */
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="x_panel">
            @include('admin.layouts.title_table', ['text' => __('admin/post.list post')])
            <div class="box-header with-border">
                @can(ability_create('post'))
                    <div class="pull-left">
                        @include('admin.layouts.widget.button.button_link.create', ['text' => __('admin/post.add post'), 'btn_size' => 'md', 'icon' => 'fa-plus', 'options' => ['data-style'=>"zoom-in", 'class' => 'ladda-button'], 'url' => route(\App\Http\Controllers\Admin\PostController::getAdminRouteName('create'))])
                    </div>
                @endcan
                @can(ability_destroy('post'))
                    @include('admin.layouts.widget.button.bulk-delete', ['table' => \App\Models\Post::table(), 'classTable' => \App\Models\Post::class, 'class' => 'pull-left'])
                @endcan
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#"></a></li>
                        <li role="modal-export" data-class_export="{{\App\Exports\ExportPost::class}}" data-columns="{{json_encode(array_keys($models->get(0)->getAttributes()))}}" data-total_record="{{count($models)}}">
                            <a href="#"><i class="fa fa-download"></i> Export</a>
                        </li>
                        <li role="modal-import" data-class_export="{{\App\imports\ImportPost::class}}" data-columns="{{json_encode(array_keys($models->get(0)->getAttributes()))}}"><a href="#"><i class="fa fa-upload"></i> Import</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="datatable-checkbox" class="table {{\App\Models\Post::table()}} table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check-all" class="">
                            </th>
                            <th>@lang('admin/common.image')</th>
                            <th>@lang('admin/common.title')</th>
                            <th>@lang('admin/news.author')</th>
                            <th>@lang('admin/menu.category')</th>
                            <th>@lang('admin/common.is_active')</th>
                            <th>@lang('admin/news.publish date')</th>
                            <th>@lang('admin/common.created date')</th>
                            <th>@lang('admin/common.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @each('admin.post._table', $models, 'model', 'admin.layouts.widget.list-empty')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scriptString')
    <script type="text/javascript">
        $(function () {
            $("[role=\"modal-export\"]").click(function () {
                let columns_export = $(this).data("columns");
                let total_record   = $(this).data("total_record");
                let class_export   = $(this).data("class_export");
                let class_model    = $(this).data("class_model");
                $.confirm({
                    title:   "Prompt!",
                    content: function () {
                        let input_column_export = "";
                        columns_export.forEach(function (item) {
                            input_column_export += `<input checked type="checkbox" class="export_columns" id="export-${item}" value="${item}" name="columns[]"><label for="export-${item}">${item}</label><br>`;
                        });
                        return "<form id='form-export' method='post' action=''>" +
                            `<h3>Chọn các trường cần Export:</h3> <div class=\"list-column-export\">${input_column_export}</div>` +
                            "<h3>Số lượng bản ghi export:</h3>" +
                            `<h4>Tổng số: ${total_record}</h4>` +
                            "<div class=\"form-group\">" +
                            "<div class=\"row\">" +
                            "<div class=\"col-md-6\">" +
                            "<label>Export from</label>" +
                            `<input type="number" name="from" placeholder="" class="form-control" required min="1" max="${total_record}" value='1'/>` +
                            "</div>" +//end col-md-6
                            "<div class=\"col-md-6\">" +
                            "<label>Số lượng</label>" +
                            `<input type="number" name="limit" placeholder="" class="form-control" required min="2" max="${total_record}" value='10'/>` +
                            "</div>" +//end col-md-6
                            "</div>" + // endrow
                            "</div>" +//end form group
                            "<h4>Chọn kiểu export</h4>" +
                            "<div class=\"form-group\">" +
                            "<select name=\"export_type\" class=\"form-control\">" +
                            "<option value='excel'>excel</option>" +
                            "<option value='csv'>csv</option>" +
                            "</select>" +
                            "</div>" + "</form><br><br>";
                    },
                    buttons: {
                        ok:      {
                            text:     "Export",
                            btnClass: "btn-blue",
                            action:   function () {
                                let data = $("#form-export").serializeArray();
                                data.push({name: "columns", value: columns_export});
                                data.push({name: "class_export", value: class_export});
                                data.push({name: "class_model", value: class_model});
                                console.log(data);
                                $.ajax({
                                    type:      "post",
                                    url:       '{{url_admin("import-export/export")}}',
                                    data:      data,
                                    xhrFields: {
                                        responseType: "blob"
                                    }
                                }).done(function (response, textStatus, request) {
                                    let content_disposition = request.getResponseHeader("content-disposition");
                                    let filenames           = content_disposition.split("filename");

                                    var a      = document.createElement("a");
                                    var url    = URL.createObjectURL(response);
                                    a.href     = url;
                                    a.download = filenames[1].replace("=", '') || "download.xlsx";
                                    a.click();
                                    URL.revokeObjectURL(url);
                                });
                            }
                        },
                        // preview: function () {
                        //     $.alert({
                        //         title:             "Asynchronous content",
                        //         content:           "url:table.html",
                        //         animation:         "scale",
                        //         columnClass:       "medium",
                        //         closeAnimation:    "scale",
                        //         backgroundDismiss: true
                        //     });
                        // },
                        cancel:  function () {
                            //close
                        }
                    }
                });
            });

            $("[role=\"modal-import\"]").click(function () {
                $.confirm({
                    title:   "Prompt!",
                    content: function () {
                        let input_column_export = "";
                        columns_export.forEach(function (item) {
                            input_column_export += `<input checked type="checkbox" class="export_columns" id="export-${item}" value="${item}" name="columns[]"><label for="export-${item}">${item}</label><br>`;
                        });
                        return "<form id='form-export' method='post' action=''>" +
                            `<h3>Chọn các trường import:</h3> <div class=\"list-column-export\">${input_column_export}</div>` +
                            "<h3>Số lượng bản ghi export:</h3>" +
                            `<h4>Tổng số: ${total_record}</h4>` +
                            "<div class=\"form-group\">" +
                            "<div class=\"row\">" +
                            "<div class=\"col-md-6\">" +
                            "<label>Export from</label>" +
                            `<input type="number" name="from" placeholder="" class="form-control" required min="1" max="${total_record}" value='1'/>` +
                            "</div>" +//end col-md-6
                            "<div class=\"col-md-6\">" +
                            "<label>Số lượng</label>" +
                            `<input type="number" name="limit" placeholder="" class="form-control" required min="2" max="${total_record}" value='10'/>` +
                            "</div>" +//end col-md-6
                            "</div>" + // endrow
                            "</div>" +//end form group
                            "<h4>Chọn kiểu export</h4>" +
                            "<div class=\"form-group\">" +
                            "<select name=\"export_type\" class=\"form-control\">" +
                            "<option value='excel'>excel</option>" +
                            "<option value='csv'>csv</option>" +
                            "</select>" +
                            "</div>" + "</form><br><br>";
                    },
                    buttons: {
                        ok:      {
                            text:     "Export",
                            btnClass: "btn-blue",
                            action:   function () {
                                let data = $("#form-export").serializeArray();
                                data.push({name: "columns", value: columns_export});
                                data.push({name: "class_export", value: class_export});
                                data.push({name: "class_model", value: class_model});
                                console.log(data);
                                $.ajax({
                                    type:      "post",
                                    url:       '{{url_admin("import-export/export")}}',
                                    data:      data,
                                    xhrFields: {
                                        responseType: "blob"
                                    }
                                }).done(function (response, textStatus, request) {
                                    let content_disposition = request.getResponseHeader("content-disposition");
                                    let filenames           = content_disposition.split("filename");

                                    var a      = document.createElement("a");
                                    var url    = URL.createObjectURL(response);
                                    a.href     = url;
                                    a.download = filenames[1].replace("=", '') || "download.xlsx";
                                    a.click();
                                    URL.revokeObjectURL(url);
                                });
                            }
                        },
                        cancel:  function () {
                            //close
                        }
                    }
                });
            });
        });
    </script>
@endpush
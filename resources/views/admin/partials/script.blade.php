<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 4:06 PM
 */
?>
@push('scriptFile')

    <!-- jQuery -->
    <script src="{{asset_admin_vendors('jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{asset_admin_vendors('bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset_admin_vendors('fastclick/lib/fastclick.js')}}" type="text/javascript"></script>
    <!-- NProgress -->
    <script src="{{asset_admin_vendors('nprogress/nprogress.js')}}" type="text/javascript"></script>
    <!-- gauge.js -->
    <script src="{{asset_admin_vendors('gauge.js/dist/gauge.min.js')}}" type="text/javascript"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset_admin_vendors('bootstrap-progressbar/bootstrap-progressbar.min.js')}}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{asset_admin_vendors('iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <!-- Skycons -->
    <script src="{{asset_admin_vendors('skycons/skycons.js')}}" type="text/javascript"></script>
    <!-- DateJS -->
    <script src="{{asset_admin_vendors('DateJS/build/date.js')}}" type="text/javascript"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="{{asset_admin_vendors('moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset_admin_vendors('bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('jquery.hotkeys/jquery.hotkeys.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('google-code-prettify/src/prettify.js')}}" type="text/javascript"></script>
    <!-- jQuery Tags Input -->
    <script src="{{asset_admin_vendors('jquery.tagsinput/src/jquery.tagsinput.js')}}" type="text/javascript"></script>
    <!-- Switchery -->
    <script src="{{asset_admin_vendors('switchery/dist/switchery.min.js')}}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{{asset_admin_vendors('select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <!-- Parsley -->
    <script src="{{asset_admin_vendors('parsleyjs/dist/parsley.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('parsleyjs/dist/i18n/vi.js')}}" type="text/javascript"></script>
    <!-- Autosize -->
    <script src="{{asset_admin_vendors('autosize/dist/autosize.min.js')}}" type="text/javascript"></script>
    <!-- jQuery autocomplete -->
    <script src="{{asset_admin_vendors('devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}" type="text/javascript"></script>
    <!-- starrr -->
    <script src="{{asset_admin_vendors('starrr/dist/starrr.js')}}" type="text/javascript"></script>
    <!--Bootstrapt fileinput-->
    <script src="{{asset_admin_vendors('bootstrap-fileinput/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('bootstrap-fileinput/js/locales/vi.js')}}" type="text/javascript"></script>
    <!-- Jquery ui -->
    <script src="{{asset_admin_vendors('jqueryui/jquery-ui.js')}}" type="text/javascript"></script>

    <!-- Custom Theme Scripts -->

    <script src="{{asset_admin_vendors('datatables.net/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-bs/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>

    <script src="{{asset_admin_vendors('datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-keytable/js/dataTables.keyTable.min.js')}}" type="text/javascript"></script>

    <script src="{{asset_admin_vendors('datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-responsive-bs/js/responsive.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-scroller/js/dataTables.scroller.min.js')}}" type="text/javascript"></script>

    <script src="{{asset_admin_vendors('datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-buttons/js/buttons.flash.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('datatables.net-buttons/js/buttons.print.min.js')}}" type="text/javascript"></script>

    <script src="{{asset_admin_vendors('pnotify/dist/pnotify.js')}}"></script>
    <script src="{{asset_admin_vendors('pnotify/dist/pnotify.buttons.js')}}"></script>
    <script src="{{asset_admin_vendors('pnotify/dist/pnotify.nonblock.js')}}"></script>

    <script src="{{asset_admin_vendors('jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('pdfmake/build/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_admin_vendors('pdfmake/build/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    @stack('scriptFileAppend')

    <script src="{{asset_admin('build/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_js('custom.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            let value1 = $("#datetimepicker1 input").attr("value");
            $("#datetimepicker1 input").attr("value", "");
            $("#datetimepicker1").datetimepicker({
                defaultDate: value1 || '{{\Illuminate\Support\Carbon::now()}}'
            });

            let value2 = $("#datetimepicker2 input").attr("value");
            $("#datetimepicker2 input").attr("value", "");
            $("#datetimepicker2").datetimepicker({
                defaultDate: value2 || '{{\Illuminate\Support\Carbon::now()}}'
            });
        });

        $(function () {
            let configCKFINDER  = {
                filebrowserBrowseUrl:      '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl:      '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            };
            let configCKFINDER1 = configCKFINDER;
            let configCKFINDER5 = configCKFINDER;

            if ($("#editor1").length > 0) {
                configCKFINDER1.height = $("#editor1").attr("height") || 500;
                CKEDITOR.replace("editor1", configCKFINDER1);
            }
            if ($("#editor").length > 0) {
                configCKFINDER1.height = $("#editor").attr("height") || 500;
                CKEDITOR.replace("editor", configCKFINDER5);
            }
        });

        $(function () {
            $("table.dataTable").DataTable({
                language: {
                    sProcessing:   "Đang xử lý...",
                    sLengthMenu:   "Xem _MENU_ mục",
                    sZeroRecords:  "Không tìm thấy dòng nào phù hợp",
                    sInfo:         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    sInfoEmpty:    "Đang xem 0 đến 0 trong tổng số 0 mục",
                    sInfoFiltered: "(được lọc từ _MAX_ mục)",
                    sInfoPostFix:  "",
                    sSearch:       "Tìm:",
                    sUrl:          "",
                    oPaginate:     {
                        sFirst:    "Đầu",
                        sPrevious: "Trước",
                        sNext:     "Tiếp",
                        sLast:     "Cuối"
                    }
                },
                destroy:  true
            });
        });

        $(function () {
            // window.Parsley.setLocale("vi");
        });

    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name=\"csrf-token\"]").attr("content")
            }
        });

        $(function () {
            $(document).on("click", "input[type=\"checkbox\"]#check-all,input[type=\"checkbox\"].check-all", function () {
                let $parent = $(this).parents("table");
                if ($(this).prop("checked")) {
                    $parent.find(".check-one").prop("checked", true);
                }
                else {
                    $parent.find(".check-one").prop("checked", false);
                }
            });

            $(document).on("click", "input[type=\"checkbox\"].check-one", function () {
                let $parent = $(this).parents("table");
                let num_row = $parent.find("tbody tr").length;
                if ($("input[type=\"checkbox\"].check-one:checked").length === num_row) {
                    $parent.find("#check-all").prop("checked", true);
                    $parent.find(".check-all").prop("checked", true);
                }
                else {
                    $parent.find("#check-all").prop("checked", false);
                    $parent.find(".check-all").prop("checked", false);
                }
            });
        });

        /**
         * @param {string} caption
         * @param {string|object} message
         * ex : message is this
         */
        function confirmDelete(message = "", caption = "{{__("admin.confirm delete item?")}}") {
            let $modal = $("#modal-alert-delete");
            $modal.find(".modal-title").text(caption);

            if (typeof message === "object") {
                let _this = message;
                message   = _this.data("modal-title");
                $modal.find(".modal-body .modal-message").text(message);
                $modal.modal();
                $("#delete-yes").click(function () {
                    console.log(_this.parents("form"));
                    _this.parents("form").unbind("submit");
                    _this.parents("form").submit();
                    return true;
                });
                $("#delete-no").click(function () {
                    $modal.close();
                    return false;
                });
                return false;
            }
        }

        /**
         * @param {string} caption
         * @param {string|object} _this
         */
        function confirmMessage(_this, caption = "{{__("admin.Confirm message")}}") {
            let $modal = $("#modal-alert-delete");
            $modal.find(".modal-title").text(caption);

            if (typeof _this === "object") {
                let message = _this.data("modal-title");
                $modal.find(".modal-body .modal-message").text(message);
                $modal.modal();
                $("#delete-yes").click(function () {
                    console.log(_this.parents("form"));
                    _this.parents("form").unbind("submit");
                    _this.parents("form").submit();
                    return true;
                });
                $("#delete-no").click(function () {
                    $modal.close();
                    return false;
                });
                return false;
            }
        }

        /**
         * @param {string} caption
         * @param {string} message
         */
        // function alert(caption = "", message = "") {
        //     let $modal = $("#modal-alert-delete");
        //     $modal.find(".modal-title").text(caption);
        //     $modal.find(".modal-body p").text(message);
        //     $modal.modal();
        //     return false;
        // }

        $(function () {
            var hash = window.location.hash;
            hash && $("ul.nav a[href=\"" + hash + "\"]").tab("show");

            $(".nav-tabs a").click(function (e) {
                $(this).tab("show");
                var scrollmem        = $("body").scrollTop() || $("html").scrollTop();
                window.location.hash = this.hash;
                $("html,body").scrollTop(scrollmem);
            });
        });

        /**
         * @param {object|string} $_this
         * @param {string} $selector_change
         * @param {string} $url
         * @param {string} $type
         */
        function getCategory($_this, $selector_change, $url, $type = "") {
            let $id  = $($_this).val();
            let $xhr = $.ajax({
                url:  $url,
                type: "get",
                data: {id: $id, type: $type}
            });

            $xhr.success(function (result) {
                if (typeof result === "string") {
                    $($selector_change).html(result);
                    return false;
                }
                console.log(result);
            });
            $xhr.error(function (error) {
                console.log(error);
            });
        }

        $(function () {
            $(document).on("change", ".get-category", function () {
                let $selector_change = $(this).data("selector_change");

                let $id   = $(this).val();
                let $type = $(this).data("type");
                let $url  = $(this).data("url");
                let $xhr  = $.ajax({
                    url:  $url,
                    type: "get",
                    data: {id: $id, type: $type}
                });

                $xhr.success(function (result) {
                    if (typeof result === "string") {
                        $($selector_change).html(result);
                        return false;
                    }
                    console.log(result);
                });
                $xhr.error(function (error) {
                    console.log(error);
                });
            });
        });
    </script>
@endpush
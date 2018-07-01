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
    <script src="{{asset_vendors('jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{asset_vendors('bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset_vendors('fastclick/lib/fastclick.js')}}" type="text/javascript"></script>
    <!-- NProgress -->
    <script src="{{asset_vendors('nprogress/nprogress.js')}}" type="text/javascript"></script>
    <!-- gauge.js -->
    <script src="{{asset_vendors('gauge.js/dist/gauge.min.js')}}" type="text/javascript"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset_vendors('bootstrap-progressbar/bootstrap-progressbar.min.js')}}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{asset_vendors('iCheck/icheck.min.js')}}" type="text/javascript"></script>
    <!-- Skycons -->
    <script src="{{asset_vendors('skycons/skycons.js')}}" type="text/javascript"></script>
    <!-- DateJS -->
    <script src="{{asset_vendors('DateJS/build/date.js')}}" type="text/javascript"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="{{asset_vendors('moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset_vendors('bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('jquery.hotkeys/jquery.hotkeys.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('google-code-prettify/src/prettify.js')}}" type="text/javascript"></script>
    <!-- jQuery Tags Input -->
    <script src="{{asset_vendors('jquery.tagsinput/src/jquery.tagsinput.js')}}" type="text/javascript"></script>
    <!-- Switchery -->
    <script src="{{asset_vendors('switchery/dist/switchery.min.js')}}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{{asset_vendors('select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <!-- Parsley -->
    <script src="{{asset_vendors('parsleyjs/dist/parsley.min.js')}}" type="text/javascript"></script>
    <!-- Autosize -->
    <script src="{{asset_vendors('autosize/dist/autosize.min.js')}}" type="text/javascript"></script>
    <!-- jQuery autocomplete -->
    <script src="{{asset_vendors('devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}" type="text/javascript"></script>
    <!-- starrr -->
    <script src="{{asset_vendors('starrr/dist/starrr.js')}}" type="text/javascript"></script>
    <!--Bootstrapt fileinput-->
    <script src="{{asset_vendors('bootstrap-fileinput/js/fileinput.js')}}" type="text/javascript"></script>
    <!-- Custom Theme Scripts -->

    <script src="{{asset_vendors('datatables.net/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-bs/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-buttons/js/buttons.flash.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-buttons/js/buttons.print.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-keytable/js/dataTables.keyTable.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-responsive-bs/js/responsive.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('datatables.net-scroller/js/dataTables.scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('pdfmake/build/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_vendors('pdfmake/build/vfs_fonts.js')}}" type="text/javascript"></script>
    @stack('scriptFileAppend')

    <script src="{{asset('build/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset_css('custom.css')}}" type="text/javascript"></script>
    <script>
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
         * @param {string} message
         */
        function confirmDelete(message = "", caption = "Delete item?") {
            let $modal = $("#modal-alert-delete");
            $modal.find('.modal-title').text(caption);


            if (typeof message === 'object') {
                let _this = message;
                message = _this.data('modal-title');
                $modal.find('.modal-body .modal-message').text(message);
                $modal.modal();
                $('#delete-yes').click(function () {
                    _this.parents('form').submit();
                    return true;
                });
                $('#delete-no').click(function () {
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
        function alert(caption = "", message = "") {
            let $modal = $("#modal-alert-delete");
            $modal.find('.modal-title').text(caption);
            $modal.find('.modal-body p').text(message);
            $modal.modal();
            return false;
        }

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
    </script>
@endpush
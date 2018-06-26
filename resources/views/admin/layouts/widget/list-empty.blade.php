@push('scriptString')
    <script type="text/javascript">
        // $("table").dataTable({
        //     language: {
        {{--emptyTable: "{{__('Không có dữ liệu')}}"--}}
        // }
        // });
        $(function () {
            $(".dataTables_empty").text("{{__('Không có dữ liệu')}}");
        });
    </script>
@endpush
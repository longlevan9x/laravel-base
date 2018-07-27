<form id="form-bulk-delete-{{$table}}" class="{{$class ?? ''}}" action="{{url_admin('bulk/bulk-delete')}}" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="table" value="{{$classTable}}">
    <input type="hidden" name="ids" id="ids" value="">
    @include('admin.layouts.widget.button.button', [
        'text' => __('admin.delete bulk'),
        'btn_size' => $btn_size ?? 'md',
        'btn_type' => "warning",
        'icon' => 'fa-remove',
        'options' => [
            'onclick' => '',
            'data-reference-to-class' => $reference ?? $table,
            'id' => "bulk-delete-" . ($id ?? $table),
            'name'=>"bulk-delete-$table",
            'data-modal-title'=> __('admin.Are you sure delete this item')
        ]
    ])
</form>
@push('scriptString')
    <script>
        $("#bulk-delete-{{$id ?? $table}}").click(function (event) {
            let _form = $("#form-bulk-delete-{{$table}}");
            _form.submit(function (e) {
                e.preventDefault();
            });

            let id_table = $(this).data("reference-to-class");
            id_table     = $(`.${id_table}`).find(".check-one");
            let ids      = id_table.map(function (index, item) {
                if ($(item).is(":checked")) {
                    return $(item).val();
                }
            }).get();
            //console.log(ids);
            if (ids.length === 0) {
                alert("Bạn chưa chọn bản ghi nào.");
                event.preventDefault();
                event.isPropagationStopped();
                return false;
            }
            _form.find("#ids").val(ids);
            return confirmDelete($(this));
            _form.unbind("submit");

        });
    </script>
@endpush
<form id="form-bulk-{{$table}}" class="{{$class ?? ''}} form-inline" action="{{url_admin('bulk/bulk')}}" method="post">
    @method('delete')
    @csrf
    <input type="hidden" name="table" value="{{$classTable}}">
    <input type="hidden" name="ids" id="ids" value="">
    <input type="hidden" name="key" value="{{$key ?? ''}}">
    <input type="hidden" name="value" value="{{$value ?? ""}}">
    @include('admin.layouts.widget.button.button', [
        'text' => $text ?? __('admin.edit'),
        'btn_size' => $btn_size ?? 'md',
        'btn_type' => "warning",
        'icon' => $icon ?? '',
        'options' => [
            'onclick' => '',
            'data-reference-to-class' => $reference ?? $table,
            'id' => "bulk-" . ($id ?? $table),
            'name'=>"bulk-$table",
            'data-modal-title'=> __('admin.are you sure you want to change this record?')
        ]
    ])
</form>
@push('scriptString')
    <script>
        $("#bulk-{{$id ?? $table}}").click(function (event) {
            let _form = $("#form-bulk-{{$table}}");
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
            return confirmDelete($(this), "{{__('admin/common.confirm edit multiple records')}}");
            _form.unbind("submit");

        });
    </script>
@endpush
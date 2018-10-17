<div class="form-group js-tag-{{$id ?? 'tag'}}">
    <label class="col-md-12 col-sm-12 col-xs-12" for="{{$id ?? 'tag'}}"> {{$text ?? __('admin/common.tags')}}</label>
    <div class="col-md-9 col-sm-9 col-xs-9">
        {!! Form::text($name ?? 'tag', $value = null,['class' => "form-control col-md-7 col-xs-12 js-input-tag-" . $id ?? 'tag' ." " . $class ?? '', 'default' => '', 'id' => $id ?? 'tag'] + $options ?? []) !!}
    </div>

    <div class="col-md-3 col-sm-3 col-xs-3">
        <button type="button" class="btn btn-default btn-block js-add-tag-{{$id ?? 'tag'}}">@lang('admin/common.add')</button>
    </div>
</div>

@push('scriptString')
    <script type="text/javascript">
        $(function () {
            $(".js-add-tag-" + "{{$id ?? 'tag'}}").on("click", function (evt) {
                let $tag = $(this).parents(".js-tag=" + "{{$id ?? 'tag'}}").find(".js-input-tag-" + "{{$id ?? 'tag'}}").val() || "";
                $.post('{{url_admin('tag')}}', {name: $tag, is_active: 1, type: "", description: "", slug: ""}, function (result) {
                    new PNotifySuccess("Thông báo", "Thêm tag thành công");
                });
                $(this).parents(".js-tag-" + "{{$id ?? 'tag'}}").find(".js-input-tag-" + "{{$id ?? 'tag'}}").val("");
            });
        });
    </script>
@endpush
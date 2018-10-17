<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="{{$name ?? 'tags'}}"> {{$text ?? __('Chọn tag có sẵn')}}</label>

    <div class="col-md-12">
        <select class="js-data-ajax-{{$id ?? 'tags'}} js-states form-control" name="{{$name ?? 'tags'}}[]" multiple="multiple" id="{{$id ?? 'tags'}}"></select>
    </div>
</div>

@push('scriptString')
    <script type="text/javascript">
        $(function () {

            var data     = JSON.parse('{!! $tags ?? '{}'!!}');
            var _select2 = $(".js-data-ajax-tag-" + "{{$id ?? 'tags'}}");
            _select2.select2({
                data: data,
                ajax: {
                    url:      '{{url_admin('ajax/select2', ['tags', 'name'])}}',
                    dataType: "json",

                    processResults: function (data) {
                        return {
                            results: data.result
                        };
                    },

                    cache: true
                }
                //tags : true
            });
            _select2.val({!! $id_tags ?? 0 !!}).trigger("change");
        });
    </script>
@endpush
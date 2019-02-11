@php
    $id = $id ?? 'tags';
    $name = $name ?? 'tags';
    $type = $type ?? '';
@endphp
<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="{{$name}}"> {{$text ?? __('repositories.tag.select_the_tag_available')}}</label>

    <div class="col-md-12">
        <select class="js-data-ajax-{{$id}} js-states form-control" name="{{$name}}[]" multiple="multiple" id="{{$id}}"></select>
    </div>
</div>

@push('scriptString')
    <script type="text/javascript">
        $(function () {

            var data     = JSON.parse('{!! $tags ?? '{}'!!}');
            var _select2 = $(".js-data-ajax-{{$id}}");
            _select2.select2({
                data: data,
                ajax: {
                    url:            '{{url_admin('ajax/select2', ['tags', 'name'])}}',
                    dataType:       "json",
                    data:           function (params) {
                        return {
                            q:          params.term,
                            term:       params.term,
                            _type:      params._type,
                            conditions: {type: '{{$type}}'}
                        };
                    },
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
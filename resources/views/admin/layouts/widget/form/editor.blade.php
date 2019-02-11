@php
    $col = $col ?? 12;
    $class = $class ?? '';
    if (!isset($name)) {
        throw  new Exception('Undefined variable $name');
    }

    $options = $options ?? [];
    $height = $height ?? 500;
    $id = $id ?? ($name ?? '');
@endphp
<div class="form-group col-md-12">
    <label class=" col-md-12 col-sm-12 col-xs-12" for="{{$id}}">{{$label ?? ''}}</label>
    <div class="col-md-{{$col}} col-sm-{{$col}} col-xs-12">
        {!! Form::textarea($name, $value = null, array_merge(['class' => "form-control col-md-7 col-xs-12 " . $class, 'id' => $id, 'height' => $height], $options)) !!}
    </div>
</div>
@push('scriptString')
    <script type="text/javascript">
        $(function () {
            let configCKFINDER = {
                filebrowserBrowseUrl:      '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl:      '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            };

            if ($("#{{$id}}").length > 0) {
                configCKFINDER.height = $("#{{$id}}").attr("height") || 500;
                CKEDITOR.replace("{{$id}}", configCKFINDER);
            }
        });
    </script>
@endpush
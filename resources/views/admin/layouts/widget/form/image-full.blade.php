@php

    $imagePreview = '';
    if(isset($imagePath) && !empty($imagePath)) {
        $imagePreview = $imagePath;
    }
    elseif (isset($model)) {
        if (method_exists($model, 'getImagePath')) {
            $imagePreview = $model->getImagePath();
        }
    }
    else {
        //$imagePreview = \App\Commons\Facade\CFile::getImageUrl('www', '');
    }
@endphp
<div class="form-group row">
    <label for="{{$id ?? 'image'}}" class="col-md-12 col-sm-12 col-xs-12">{{$label ?? __('admin/common.image')}}</label>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <input id="{{$id ?? 'image'}}" data-language="vi" type="file" accept="{{$accept ?? 'image/*'}}" name="{{$name ?? ($id ?? 'image') }}" value="" class="file dropify form-control-file" aria-describedby="fileHelp">
    </div>
</div>
@push('scriptString')
    <script>
        let configFileinput = {
            dropZoneEnabled:      false,
            showUpload:           false,
            initialPreviewAsData: true,
            initialPreviewConfig: [
                {caption: "logo.png"}
            ]
        };
        let _imagePreview   = '{{$imagePreview}}';
        if (_imagePreview !== "") {
            configFileinput.dropZoneEnabled = true;
            configFileinput.initialPreview  = _imagePreview;
        }

        $("#{{$id ?? 'image'}}").fileinput(configFileinput);
    </script>
@endpush
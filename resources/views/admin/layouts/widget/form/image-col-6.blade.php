@php
    $imagePreview = '';
    if (isset($model)) {
        if (method_exists($model, 'getImagePath')) {
            $imagePreview = $model->getImagePath();
        }
    }
    elseif(isset($imagePath) && !empty($imagePath)) {
        $imagePreview = $imagePath;
    }
    else {
        //$imagePreview = \App\Commons\Facade\CFile::getImageUrl('www', '');
    }
@endphp
<div class="form-group">
    <label for="{{$id ?? 'image'}}" class="control-label col-md-3 col-sm-3 col-xs-12">{{$label ?? __('admin/common.image')}}</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
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
        let _imagePreview = '{{$imagePreview}}';
        if (_imagePreview !== '') {
            configFileinput.dropZoneEnabled = true;
            configFileinput.initialPreview = _imagePreview;
        }

        $("#{{$id ?? 'image'}}").fileinput(configFileinput);
    </script>
@endpush
@php
    $showType = $showType ?? "";
    $imagePreview = '';
    $maxImageWidth  = $maxImageWidth ?? 0;
    $maxImageHeight = $maxImageHeight ?? 0;
    $urlDelete = $urlDelete ?? '';

    if (isset($model)) {
        if (method_exists($model, 'getImagePathWithoutDefault')) {
            $imagePreview = $model->getImagePathWithoutDefault();
        }

        if (empty($urlDelete)) {
            $urlDelete = isset($model) ? $model->getUrlDeleteImage($name ?? 'image') : '';
        }

        if ($maxImageWidth == 0) {
            if (key_exists("max".ucfirst($name ?? 'image').'Height', $model)) {
        	    $maxImageWidth = $model->{"getMax".ucfirst($name ?? 'image').'Width'}();
            }
        }

        if ($maxImageHeight == 0) {
            if (key_exists("max".ucfirst($name ?? 'image').'Height', $model)) {
        	    $maxImageHeight = $model->{"getMax".ucfirst($name ?? 'image')."Height"}();
            }
        }
    }
    if(isset($imagePath) && !empty($imagePath)) {
        $imagePreview = $imagePath;
    }
    //else {
        //$imagePreview = \App\Commons\Facade\CFile::getImageUrl('www', '');
    //}
@endphp
<div class="form-group row">
    {{--dk1 la cai ngoai cung: show type = 'col-6'--}}
    {{--dk2 trong ngoac : show type = full --}}
    {{--neu ko vao 2 dk thi lay mac dinh--}}
    <label for="{{$id ?? ($name ?? 'image')}}" class="{{$showType == 'col-6' ? 'control-label col-md-3 col-sm-3 col-xs-12' : ($showType == 'full' ? 'col-md-12 col-sm-12 col-xs-12' : 'col-xs-2 col-form-label') }}">{{$label ?? __('admin/common.image')}}</label>
    <div class="{{$showType == 'col-6' ? 'col-md-6 col-sm-6 col-xs-12' : ($showType == 'full' ? 'col-md-12 col-sm-12 col-xs-12' : 'col-xs-10') }}">
        <input id="{{$id ?? ($name ?? 'image')}}" data-language="vi" type="file" accept="{{$accept ?? 'image/*'}}" name="{{$name ?? ($id ?? 'image') }}" value="" class="file dropify form-control-file" aria-describedby="fileHelp">
        @if($maxImageWidth > 0 && $maxImageHeight > 0)<span class="help-block">@lang('admin/widget.standard image size'): (W * H) : {{$maxImageWidth}} * {{$maxImageHeight}}</span> @endif
    </div>
</div>
@push('scriptString')
    <script>
        let configFileinput{{$id ?? ($name ?? 'image')}} = {
            dropZoneEnabled:      false,
            showUpload:           false,
            initialPreviewAsData: true,
            maxImageWidth:        200,
            maxImageHeight:       150,
            resizePreference:     "height",
            resizeImage:          true,
            initialPreviewConfig: [
                {caption: "{{$model->{$name ?? 'image'} ?? 'no_image.png'}}", url: '{{$urlDelete}}'}
            ]
        };
        let _imagePreview{{$id ?? ($name ?? 'image')}}   = '{{$imagePreview}}';
        if (_imagePreview{{$id ?? ($name ?? 'image')}} !== "") {
            configFileinput{{$id ?? ($name ?? 'image')}}.dropZoneEnabled = true;
            configFileinput{{$id ?? ($name ?? 'image')}}.initialPreview  = _imagePreview{{$id ?? ($name ?? 'image')}};
        }

        $("#{{$id ?? 'image'}}").fileinput(configFileinput{{$id ?? ($name ?? 'image')}});
        $("#{{$id ?? 'image'}}").on("filepredelete", function (jqXHR) {
            var abort = true;
            if (confirm("Are you sure you want to delete this image?")) {
                abort = false;
            }
            return abort; // you can also send any data/object that you can receive on `filecustomerror` event
        });
    </script>
@endpush
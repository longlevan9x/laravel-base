@include('admin.layouts.widget.form.image',
[
    'imagePath' => $imagePath ?? '',
    'urlDelete' => $urlDelete ?? '',
    'showType'  => 'col-6',
    'model'     => $model ?? null,
    'name'      => $name ?? 'image',
    'id'        => $id ?? ($name ?? 'image'),
    'accept'    => $accept ?? 'image/*',
    'maxImageHeight' => $maxImageHeight ?? 0,
    'maxImageWidth'  => $maxImageWidth ?? 0,
    'label'     => $label ?? __('admin/common.image')
])
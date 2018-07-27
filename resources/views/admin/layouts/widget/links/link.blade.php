@php
    $url = $url ?? "";
    $params = $params ?? '';
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        url($url, $params);
    }
@endphp
<style type="text/css">
    .row-title:hover {
        color: #00a0d2;
        text-decoration: underline;
    }
</style>
<a class="row-title" title="@lang('admin.view on website')" href="{!! $url !!}" style="color: #0073aa;">{{$text ?? ''}}</a>
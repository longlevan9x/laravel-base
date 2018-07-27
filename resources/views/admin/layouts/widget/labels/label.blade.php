@php
    $size = $size ?? '';
    $label = "<span class=\"label label-$type\">$text</span>"
@endphp
@if($size == 'lg')
    <h3>{!! $label !!}</h3>
@elseif($size == 'md')
    <h2>{!! $label !!}</h2>
@elseif($size == 'sm')
    <h4>{!! $label !!}</h4>
@elseif($size == 'xs')
    <h5>{!! $label !!}</h5>
@else
    {!! $label !!}
@endif

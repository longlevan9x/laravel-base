@php
    $str_option = "";
    $btn_size = $btn_size ?? 'sm';
    $btn_type = $btn_type ?? 'primary';
    $class = $class ?? '';
    $class .= " btn btn-{$btn_size} btn-{$btn_type}  ";
    $id = $id ?? '';
    if (isset($options) && !empty($options)) {
        foreach ($options as $key => $option) {
            if ($key == 'class') {
                $class .= " $option";
            }
            elseif ($key == 'href' || $key == 'url') {
                $url = $option;
            }
            elseif ($key == 'id') {
                $id .= " $id";
            }
            else {
        	    $str_option .= "$key=\"$option\"";
            }
        }
    }
    $icon = $icon ?? '';
@endphp
<a href="{{$url}}" class="{{$class}}" {!! $str_option !!}>
    @if(strpos($icon, 'fa-') > -1)
        <i class='fa {{$icon}}'></i>
    @else
        <span class="glyphicon {{$icon}}"></span>
    @endif
    {{$text or ""}}
</a>
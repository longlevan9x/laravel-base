@php
    $str_option = "";
    $btn_size = $btn_size ?? 'sm';
    $btn_type = $btn_type ?? 'primary';
    $class = "btn btn-{$btn_size} btn-{$btn_type}";
    $name = $name ?? 'btn';
    $id = $id ?? 'id';
    if (isset($options) && !empty($options)) {
        foreach ($options as $key => $option) {
            if ($key == 'class') {
                $class .= " $option";
            }
            elseif ($key == 'href' || $key == 'url') {
                $url = $option;
            }
            elseif ($key == 'name') {
                $name = $option;
            }
            elseif ($key == 'id') {
                $id = $option;
            }
            else {
        	    $str_option .= "$key=\"$option\"";
            }
        }
    }
    $icon = $icon ?? '';
@endphp
<button type="{{$type ?? ""}}" class="{{$class}}" {!! $str_option !!} data-url="{{$url ?? ''}}" name="{{$name}}" id="{{$id}}">
    @if(strpos($icon, 'fa-') > -1)
        <i class='fa {{$icon}}'></i>
    @else
        <span class="glyphicon {{$icon}}"></span>
    @endif
    {{$text or ""}}
</button>
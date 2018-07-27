@php
    $class = $class ?? '';
@endphp
<div class="form-group">
    <label class="col-md-12 col-sm-12 col-xs-12" for="{{$name ?? ($id ?? '')}}"> {{__('admin/news.publish date')}}</label>
    <div class='input-group date' id='{{$name ?? ($id ?? '')}}'>
        <div class="col-md-12" style="padding-right: 0">
            {!! Form::text($name ?? '', $value = null, array_merge(['class' => 'form-control col-md-7 col-xs-12 ' . $class, 'default' => '', 'id' => $name ?? ($id ?? '')], $options ?? [])) !!}
        </div>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>
@push('scriptString')
    <script type="text/javascript">
        $(function () {
            let value = $("#{{$name ?? ($id ?? '')}} input").attr("value");
            $("#{{$name ?? ($id ?? '')}} input").attr("value", "");
            $("#{{$name ?? ($id ?? '')}}").datetimepicker({
                defaultDate: value || '{{\Illuminate\Support\Carbon::now()}}'
            });
        });
    </script>
@endpush
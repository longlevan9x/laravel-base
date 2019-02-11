<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 10:56 PM
 */
/** @var \Illuminate\Support\Collection $abilities */
$abilities = $abilities->groupBy(function($item, $key) {
	$parts      = explode('-', $item->name);
	if (count($parts) == 3) {

    }
    else {

    }
	$item->name = __('abilities.title.' . $parts[1]) . '-' . __('abilities.' . $parts[0] . '.name');

	return __('abilities.' . $parts[0] . '.name');
});

?>
@push('cssString')
    <style type="text/css">
        .tag::after {
            content: none!important;
        }
    </style>
@endpush
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                {{ Form::model(isset($model) ? $model : null, [
                    'url' => \App\Http\Controllers\Admin\RoleController::getUrlAdminWithModel($model),
                    'files' => true,
                    'class' => 'form-horizontal form-label-left',
                    'id' => 'demo-form2',
                    'data-parsley-validate',
                    'method' => action_method_push_post($model),
                ]) }}
                @include('admin.layouts.title_form', ['title' => __('abilities.role.resource.create')])
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12 col-sm-12 col-xs-12" for="name">{!! __('admin/common.name') !!}<span class="required">*</span></label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                {!! Form::text('name', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12 col-sm-12 col-xs-12" for="title">{!! __('admin/common.title') !!}</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                {!! Form::text('title', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'title']) !!}
                            </div>
                        </div>
                    </div>
                    {{--@if($model->level != 1)--}}
                    {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                    {{--<label class="col-md-12 col-sm-12 col-xs-12" for="level">{!! __('level') !!}<span class="required">*</span></label>--}}
                    {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                    {{--{!! Form::select('level', config('common.role.levels'), $value = null , ['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'level']) !!}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                </div>
                {{--                @if($model->level != 1)--}}
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{Form::checkbox('check_all', 0, null, ['id' => 'check_all'])}} {{ __('abilities.permission') }} </h3>
                    </div>
                    <div class="panel-body">
                        @foreach ($abilities as $key => $group)

                            <label class="control-label">{{Form::checkbox('check_all_group', 0, null, ['class' => 'check_all_group', 'id' => str_slug($key)])}} {{ $key }} </label>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($group->pluck('name', 'id') as $id => $name)
										<?php
										$checked = (isset($model) && isset($model->abilities->keyBy('id')[$id])) ? true : false;
										?>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label>
                                                    {{ Form::checkbox('ability_ids[]', $id, $checked, ['class' => "ability_ids " . str_slug($key)]) }} {{ $name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--@endif--}}
                <div class="col-md-12">

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;@lang('admin.saveButton')</button>
                            @include('admin.layouts.widget.button.button_link.button', ['text' => __('admin.backButton'), 'icon' => 'fa-mail-reply', 'btn_type' => 'default', 'url' => url_admin('role'), 'btn_size' => 'md'])
                        </div>
                    </div>

                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@push('scriptString')
    <script type="text/javascript">
        $(function () {
            $(window).on("load", function () {
                if ($("input.ability_ids:checked").length === $("input.ability_ids").length) {
                    $("input#check_all").prop("checked", true);
                }
                else {
                    $("input#check_all").prop("checked", false);
                }

                $("input.check_all_group").each(function (index, element) {
                    let _class = $(element).attr("id");
                    if ($("input." + _class + ":checked").length === $("input." + _class).length) {
                        $("input#" + _class).prop("checked", true);
                    }
                    else {
                        $("input#" + _class).prop("checked", false);
                    }
                });

            });

            $("input#check_all").on("click", function () {
                if ($(this).prop("checked")) {
                    $("input.ability_ids").prop("checked", true);
                    $("input.check_all_group").prop("checked", true);
                }
                else {
                    $("input.check_all_group").prop("checked", false);
                    $("input.ability_ids").prop("checked", false);
                }
            });

            $("input.check_all_group").on("click", function () {
                let _class = $(this).attr("id");
                if ($(this).prop("checked")) {
                    $("input." + _class).prop("checked", true);
                }
                else {
                    $("input." + _class).prop("checked", false);
                }
            });

            $("input.ability_ids").on("click", function () {
                let _class = $(this).attr("class").split(" ")[1] || "";
                if ($(this).prop("checked")) {
                    if ($("input." + _class + ":checked").length === $("input." + _class).length) {
                        $("input#" + _class).prop("checked", true);
                    }
                    else {
                        $("input#" + _class).prop("checked", false);
                    }

                    if ($("input.ability_ids:checked").length === $("input.ability_ids").length) {
                        $("input#check_all").prop("checked", true);
                    }
                    else {
                        $("input#check_all").prop("checked", false);
                    }
                }
                else {
                    $("input#" + _class).prop("checked", false);
                    $("input#check_all").prop("checked", false);
                }
            });
        });
    </script>
@endpush
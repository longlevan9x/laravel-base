@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
                @include('admin.layouts.title_form', ['title' => __('Form Menu')])
                <div class="x_content">
                    {{ Form::model(isset($model) ? $model : null, [
                        'url' => \App\Http\Controllers\Admin\MenuController::getUrlAdmin(isset($model) ? $model->id : ''),
                        'files' => true,
                        'class' => 'form-horizontal form-label-left',
                        'id' => 'demo-form2',
                        'data-parsley-validate',
                        'method' => action_method_push_post($model)
                    ]) }}

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="title">@lang('admin/common.title')
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            {!! Form::text('name', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'title']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="sort_order">@lang('admin/common.sort_order')</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            {!! Form::number('sort_order', $value = null,['required' => "required", 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'sort_order']) !!}
                        </div>
                        <label class=" col-md-3 col-sm-3 col-xs-12">@lang('admin/common.is_active')</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="">
                                <label>
                                    {!! Form::hidden('is_active', $value = 0) !!}
                                    {!! Form::checkbox('is_active', $value = 1,$value = null, ['class' => 'js-switch']) !!}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="url">@lang('admin/category.slug')</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            {!! Form::text('url', $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'url']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="type">@lang('admin/category.type')</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            {!! Form::select('type', config('common.menu.name'), $value = null,['class' => 'form-control col-md-7 col-xs-12', 'id' => 'type']) !!}
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            @include('admin.layouts.widget.button.button', ['text' => __('admin.updateButton'), 'icon' => "fa-save"])
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
                @include('admin.layouts.title_form', ['title' => __('admin/menu.sort_order_menu')])
                <div class="x_content">
                    <ul id="sortable">
                        @forelse($models as $model)
                            <li id="items-{{$model->id}}" style="height: 50px;vertical-align: middle;list-style: none;line-height: 50px;cursor: move;padding: 0 10px;" class="ui-state-default">
                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$model->name}}
                                <div class="pull-right" style="vertical-align: middle;color:#fff;">
                                    @can(ability_edit('menu'))
                                        <a href="{{url_admin('menu', [$model->id, 'edit'])}}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scriptString')
        <script>
            $(function () {
                let typeList = '{!! json_encode(config('common.menu.url')) !!}';
                typeList     = JSON.parse(typeList);
                $("#sortable").sortable({
                    axis:   "y",
                    update: function (event, ui) {
                        var data = $(this).sortable("serialize");
                        // POST to server using $.post or $.ajax
                        $.ajax({
                            data:    data,
                            type:    "POST",
                            url:     "{{url_admin('menu/sort-order')}}",
                            success: function (response) {
                                if (response.message === "success") {
                                    PNotifySuccess("Thông báo", "Thứ tự đã được thay đổi.");
                                }
                            }
                        });
                    }
                });

                $("#type").change(function () {
                    $("#url").val(typeList[$(this).val()]);
                });
            });
        </script>
    @endpush
    {{--@include('admin.menu.list', compact('models'))--}}
@endsection
@extends('plugins.translation-manager.layout')
@section('content')
    <script>
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                beforeSend: function (xhr, settings) {
                    //console.log("beforesend");
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });

            $(".editable").editable();
        });
    </script>
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <li role="presentation" class="dropdown">
                <a class="btn btn-primary" href="{{url_query("translation-manager/$locale")}}"><i class="fa fa-arrow-circle-left"></i>&nbsp;@lang('admin.buttons.back')</a>
            </li>
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @lang('admin/menu.language.name') <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @forelse(config('common.language.locales') as $_locale => $text)
                        <li role="presentation" class=""><a href="{{url_query("translation-manager/$_locale/edit", ['directory' => $directory])}}">{{$text}}</a></li>
                    @empty
                    @endforelse
                </ul>
            </li>
        </ul>
        <div class="col-md-12">
            <h3>@lang('repositories.text.attention')</h3>
            <ol>
                <li>@lang('repositories.text.do_not_edit_the_start_letters') "<b><mark>:</mark></b>"</li>
                <li><b><mark>Empty</mark></b> @lang('repositories.text.is_not_available,_need_to_add new')</li>
            </ol>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>{{$defaultLocale}}</th>
                    <th>{{$locale}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($defaultTransitions as $key => $translation)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$translation}}</td>
                        <td>
                            <a href="#edit" class="edittable editable editable-pre-wrapped editable-click editable-empty" data-name="{{$locale}}|{{$key}}" data-locale="{{$locale}}" data-type="textarea" data-value="{{$transitions[$key] ?? ''}}" data-title="Enter translation" data-url="{{url_query("translation-manager/$locale/edit", ['directory' => $directory])}}" data-pk>{{$transitions[$key] ?? ''}}</a>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
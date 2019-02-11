<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 5:01 PM
 */
?>
<div class="navbar nav_title" style="border: 0;">
    {{--<img class="img-circle" src="{{\App\Commons\Facade\CFile::getImageUrl('settings', setting(KEY_LOGO))}}" alt="">--}}
    <a href="{{url('/')}}" class="site_title user-profile" style="color: #E7E7E7!important;height: auto!important;margin-top: 10px;line-height: 30px;" title="@lang('admin/common.visit website')">
        <img class="img-circle" src="{{\App\Commons\Facade\CFile::getImageUrl('settings', setting(KEY_LOGO))}}" alt="">
        <span>{{setting(KEY_WEBSITE_NAME, \App\Commons\Facade\Common::showAppName(config('app.name')))}}</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
{{--<div class="profile clearfix">--}}
{{--<div class="profile_pic user-profile">--}}
{{--<img style="width: 58px;height: 58px;" src="{{\App\Commons\Facade\CUser::userAdmin()->getImagePath()}}" alt="..." class="img-circle profile_img">--}}
{{--</div>--}}
{{--<div class="profile_info">--}}
{{--<span>{{__('admin.welcome')}},</span>--}}
{{--<h2>{{\App\Commons\Facade\CUser::userAdmin()->name}}</h2>--}}
{{--</div>--}}
{{--</div>--}}
<!-- /menu profile quick info -->

<br />


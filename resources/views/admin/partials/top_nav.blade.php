<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 5:01 PM
 */
?>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{\App\Commons\Facade\CUser::userAdmin()->getImagePath()}}" alt="">{{\App\Commons\Facade\CUser::userAdmin()->name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{url_admin('profile')}}"> {{__('admin/menu.Profile')}}</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>{{__('admin.setting')}}</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">{{__('admin.help')}}</a></li>
                        <li>
                            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> {{__('auth.log out')}}</a>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="" title="Tư vấn">
                    <a href="{{url_admin('website/subscribe')}}" class=" info-number" data-toggle="" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-green">{{$totalNewSubscribe}}</span>
                    </a>
                </li>

                <li role="presentation" class="" title="Liên hệ">
                    <a href="{{url_admin('website/contact')}}" class=" info-number" data-toggle="" aria-expanded="false">
                        <i class="fa fa-linode"></i>
                        <span class="badge bg-green">{{$totalNewContact}}</span>
                    </a>
                </li>
            </ul>

        </nav>
    </div>
</div>
<!-- /top navigation -->


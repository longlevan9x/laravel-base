<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 4:05 PM
 */
?>

@push('menu_left')
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
        @include('admin.partials.profile_navigation')
        <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3>General</h3>
                    <ul class="nav side-menu">
                        @foreach($menus as $menu)
                            @if($menu['visible'])
                                @if(empty($menu['children']))
                                    <li>
                                        <a href="{{$menu['url']}}">{!! strpos($menu['icon'], 'fa-') == 0 ? "<i class='fa " . $menu['icon']. "'></i>" : "<span class='glyphicon " . $menu['icon'] . "'></span>" !!} {{$menu['name']}} </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{$menu['url']}}">{!! strpos($menu['icon'], 'fa-') == 0 ? "<i class='fa " . $menu['icon']. "'></i>" : "<span class='glyphicon " . $menu['icon'] . "'></span>" !!} {{$menu['name']}} <span class="fa fa-chevron-right"></span></a>
                                        <ul class="nav child_menu">
                                            @foreach($menu['children'] as $child)
                                                <li>
                                                    <a href="{{$child['url']}}">{!! strpos($child['icon'], 'fa-') == 0 ? "<i class='fa " . $child['icon']. "'></i>" : "<span class='glyphicon " . $child['icon'] . "'></span>" !!} {{$child['name']}} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Settings">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Lock">
                    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
                <form id="logout-form" action="{{ route(\App\Http\Controllers\Admin\AdminAuth\LoginController::getAdminRouteName('logout')) }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <!-- /menu footer buttons -->
        </div>
    </div>
    @include('admin.partials.top_nav')
@endpush

<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/7/2018
 * Time: 2:42 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
    @include('admin.partials.style')
    @stack('cssFile')
    @stack('cssString')
    @include('admin.partials.script')
    @include('admin.partials.menu')
    @include('admin.partials.header')
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @stack('menu_left')
            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->
            @yield('mainContent')
            @include('admin.partials.footer')
        </div>
    </div>
    @stack("scriptFile")
    @stack('scriptString')
</body>
</html>


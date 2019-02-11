<?php
view()->addNamespace("login_view", public_path('log_in'));
$action              = route(\App\Http\Controllers\Admin\AdminAuth\LoginController::getAdminRouteName('login'));
$background_image    = \App\Commons\Facade\CFile::getImageUrl('settings', setting(config('common.settings.keys._background_login')));
$website_name        = setting(KEY_WEBSITE_NAME, config('app.name'));
$website_description = setting(KEY_WEBSITE_DESCRIPTION);
$website_logo        = \App\Commons\Facade\CFile::getImageUrl('settings', setting(KEY_LOGO));
$login_title         = __('auth.login to continue');

$version = setting(config('common.settings.keys._v_login'), config('common.settings.login_versions.v3'));
?>
@include('login_view::login_'.$version.'.index')
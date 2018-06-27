<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/26/2018
 * Time: 11:26 PM
 */

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminAuth\LoginController as AdminLoginController;

use Illuminate\Support\Facades\Route;

/*===========Login Route============*/
Route::get(AdminLoginController::getResourceName(), AdminLoginController::getControllerWithAction('showLoginForm', 'AdminAuth'))
     ->name(AdminLoginController::getAdminRouteName('show-login'));
Route::post(AdminLoginController::getResourceName(), AdminLoginController::getControllerWithAction('login', 'AdminAuth'))
     ->name(AdminLoginController::getAdminRouteName('login'));
/*===========Login Route============*/

/*===========Dashboard Route============*/
Route::get('/', DashboardController::getControllerWithAction('index'))
     ->name(DashboardController::getAdminRouteName('dashboard'));
Route::get(DashboardController::getResourceName(), DashboardController::getControllerWithAction('index'))
     ->name(DashboardController::getAdminRouteName('dashboard'));
/*===========Dashboard Route============*/

Route::middleware(['admin', 'auth:admin'])->group(function() {
	Route::resource(SettingController::getResourceName(), SettingController::getClassName());
});


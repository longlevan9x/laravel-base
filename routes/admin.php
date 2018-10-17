<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/26/2018
 * Time: 11:26 PM
 */

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BulkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminAuth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\WebsiteController;

Route::middleware(['admin.guest'])->group(function() {
	/*===========Login Route============*/
	Route::get(AdminLoginController::getResourceName(), AdminLoginController::getControllerWithAction('showLoginForm', 'AdminAuth'))
	     ->name(AdminLoginController::getAdminRouteName('show-login'));
	Route::post(AdminLoginController::getResourceName(), AdminLoginController::getControllerWithAction('login', 'AdminAuth'))->name(AdminLoginController::getAdminRouteName('login'));
	/*===========Login Route============*/

});

Route::middleware(['admin', 'auth:admin'])->group(function() {
	Route::get('refresh-cache', 'WebsiteController@refreshCache');

	Route::post('logout', AdminLoginController::getControllerWithAction('logout', 'AdminAuth'))->name(AdminLoginController::getAdminRouteName('logout'));
	Route::post('change-password', AdminController::getControllerWithAction('change_password'))->name(AdminController::getAdminRouteName('change-password'));
	/*===========Profile============*/
	Route::get('profile', AdminController::getControllerWithAction('show_profile'))->name(AdminController::getAdminRouteName('show-profile'));
	Route::post('profile/{id}', AdminController::getControllerWithAction('update_profile'))->name(AdminController::getAdminRouteName('update-profile'));
	/*===========Profile============*/
	/*===========Dashboard Route============*/
	Route::get('/', DashboardController::getControllerWithAction('index'))->name(DashboardController::getAdminRouteName('dashboard'));
	Route::get(DashboardController::getResourceName(), DashboardController::getControllerWithAction('index'))->name(DashboardController::getAdminRouteName('dashboard'));
	/*===========Dashboard Route============*/

	Route::get(CategoryController::getResourceName('get-category'), CategoryController::getControllerWithAction('getOptionCategoryWithType'));
	Route::get(WebsiteController::getResourceName('video'), WebsiteController::getControllerWithAction('showVideo'));
	Route::post(WebsiteController::getResourceName('video'), WebsiteController::getControllerWithAction('postVideo'));
	Route::get(WebsiteController::getResourceName('config'), WebsiteController::getControllerWithAction('showConfig'));
	Route::post(WebsiteController::getResourceName('config'), WebsiteController::getControllerWithAction('postConfig'));
	Route::get(WebsiteController::getResourceName('message'), WebsiteController::getControllerWithAction('showMessage'));
	Route::post(WebsiteController::getResourceName('message'), WebsiteController::getControllerWithAction('postMessage'));
	Route::get(MenuController::getResourceName('sort-order'), MenuController::getControllerWithAction('showSortOrder'));
	Route::post(MenuController::getResourceName('sort-order'), MenuController::getControllerWithAction('postSortOrder'));

	/*===========Resource===========*/
	Route::resource(SettingController::getResourceName(), SettingController::getClassName());
	Route::resource(CategoryController::getResourceName(), CategoryController::getClassName());
	Route::resource(AdminController::getResourceName(), AdminController::getClassName());
	Route::resource(WebsiteController::getResourceName(), WebsiteController::getClassName());
	Route::resource(MenuController::getResourceName(), MenuController::getClassName());

	/*===========Route Ajax===========*/
	Route::post(AjaxController::getResourceName('delete-file/{table}/{key}/{id?}'), AjaxController::getControllerWithAction('deleteFile'));
	Route::get(AjaxController::getResourceName('select2/{table}/{column}'), AjaxController::getControllerWithAction('select2'));
	/*===========Route Bulk===========*/
	Route::delete(BulkController::getResourceName('bulk-delete'), BulkController::getControllerWithAction('bulkDelete'));
	Route::delete(BulkController::getResourceName('bulk'), BulkController::getControllerWithAction('bulk'));
});


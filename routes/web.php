<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ScheduleExamController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SyncController;
use App\Http\Controllers\Admin\SyncHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
	return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->group(function() {
	Route::get('/', DashboardController::getControllerWithAction('index'))->name(DashboardController::getAdminRouteName('dashboard'));
	Route::get(DashboardController::getResourceName(), DashboardController::getControllerWithAction('index'))->name(DashboardController::getAdminRouteName('dashboard'));
	Route::resource(SettingController::getResourceName(), SettingController::getClassName());
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

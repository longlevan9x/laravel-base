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
	Route::resource(DepartmentController::getResourceName(), DepartmentController::getClassName());

	Route::resource(SemesterController::getResourceName(), SemesterController::getClassName());
	Route::prefix(SemesterController::getResourceName())->group(function() {
		Route::post('sync-semester', SemesterController::getControllerWithAction('syncSemester'))->name(SemesterController::getAdminRouteName('sync-semester'));
	});

	Route::resource(StudentController::getResourceName(), StudentController::getClassName());
	Route::prefix(StudentController::getResourceName())->group(function() {
		Route::post('sync-info-student-by-department', StudentController::getControllerWithAction('syncInformationStudentByDepartment'))->name(StudentController::getAdminRouteName('sync-info-student-by-department'));
	});

	Route::resource(ScheduleController::getResourceName(), ScheduleController::getClassName());
	Route::prefix(ScheduleController::getResourceName())->group(function() {
		Route::post('sync-schedule-by-department', ScheduleController::getControllerWithAction('syncScheduleByDepartment'))->name(ScheduleController::getAdminRouteName('sync-schedule-by-department'));
	});

	Route::resource(ScheduleExamController::getResourceName(), ScheduleExamController::getClassName());
	Route::prefix(ScheduleExamController::getResourceName())->group(function() {
		Route::post('sync-schedule-exam-by-department', ScheduleExamController::getControllerWithAction('syncScheduleExamByDepartment'))->name(ScheduleExamController::getAdminRouteName('sync-schedule-exam-by-department'));
	});

	Route::resource(SyncController::getResourceName(), SyncController::getClassName());
	Route::prefix(SyncController::getResourceName())->group(function() {
		Route::get('/', SyncController::getControllerWithAction('index'))->name(SyncController::getAdminRouteName('index'));
		Route::post('/sync-student-schedule-by-department', SyncController::getControllerWithAction('syncStudentScheduleByDepartment'))->name(SyncController::getAdminRouteName('sync-student-schedule-by-department'));
		Route::post('/sync-student-schedule-exam-by-department', SyncController::getControllerWithAction('syncStudentScheduleExamByDepartment'))->name(SyncController::getAdminRouteName('sync-student-schedule-exam-by-department'));
	});

	Route::resource(SyncHistoryController::getResourceName(), SyncHistoryController::getClassName());
	Route::resource(SettingController::getResourceName(), SettingController::getClassName());
	Route::resource(AreaController::getResourceName(), AreaController::getClassName());

	Route::resource(CourseController::getResourceName(), CourseController::getClassName());
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

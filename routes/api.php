<?php

use App\Http\Controllers\Api\v1\ScheduleController;
use App\Http\Controllers\Api\v1\SemesterController;
use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->namespace('Api\v1')->group(function () {
    Route::get(ScheduleController::getResourceName(), ScheduleController::getControllerWithAction('getSchedule'));
//	Route::resource('student', 'StudentController');
	Route::get('students', StudentController::getControllerWithAction('getStudents'));
	Route::prefix(StudentController::getResourceName())->group(function () {
        Route::get('/{msv}', StudentController::getControllerWithAction('getStudent'));
        Route::get('/{msv}/sync', StudentController::getControllerWithAction('syncStudent'));
    });

	Route::resource( SemesterController::getResourceName(), SemesterController::getClassName());
});

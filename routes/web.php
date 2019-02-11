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

use App\Http\Controllers\Website\CustomerController;
use App\Http\Controllers\Website\HomeController;

use Illuminate\Support\Facades\Route;

//
Route::get('/', function() {
	return view('welcome');
});


Route::get('admin', function() {
	return redirect(url_admin('login'));
});


Auth::routes();

Route::middleware('auth')->group(function() {
	Route::get('/changePassword', 'Auth\ChangePassController@showChangePassword')->name('show-change-pass');
	Route::post('changePassword', 'Auth\ChangePassController@changePassword')->name('change-pass');
});

Route::get('/verification/{email}/{authen_key}', 'Auth\VerificationController@verification')->name('auth.verification');

Route::get('translation-manager/{locale?}', 'TranslationManagerController@index')->name('translation.index');
Route::get('translation-manager/{locale}/edit/{file?}', 'TranslationManagerController@edit')->name('translation.edit');
Route::post('translation-manager/{locale}/edit/{file?}', 'TranslationManagerController@update')->name('translation.edit');

Route::namespace('Website')->group(function() {
	//Route::get('/', 'HomeController@index')->name('home');

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/trang-chu', 'HomeController@index')->name('home.trang-chu');
	Route::get('/change-locale/{locale}', HomeController::getControllerWithAction('changeLocale'))->name('home.change-locale');

	Route::middleware('auth')->group(function() {
		/*User*/
		Route::get(CustomerController::getResourceName('profile'), CustomerController::getControllerWithAction('showProfile'))->name('customer.profile');
		Route::post(CustomerController::getResourceName('profile'), CustomerController::getControllerWithAction('postProfile'))->name('customer.profile');
		Route::get(CustomerController::getResourceName('change-password'), CustomerController::getControllerWithAction('showChangePassword'))->name('customer.change-password');
		Route::Post(CustomerController::getResourceName('change-password'), CustomerController::getControllerWithAction('postChangePassword'))->name('customer.change-password');
		/*User*/
	});
});



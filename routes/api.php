<?php

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

Route::prefix('v1')->group(function() {
	Route::prefix("post")->group(function() {
		Route::get('/', 'Api\v1\PostController@index');
		Route::get('/top', 'Api\v1\PostController@postTop');
		Route::get('/popular', 'Api\v1\PostController@postPopular');
		Route::get("{slug}", 'Api\v1\PostController@getBySlug');
	});

	Route::prefix('category')->group(function() {
		Route::get('/', 'Api\v1\CategoryController@index');
		Route::get("{slug}", 'Api\v1\CategoryController@showBySlug');
	});
});

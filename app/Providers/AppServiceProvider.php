<?php

namespace App\Providers;

use App\Http\Controllers\Admin\MenuController;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 * @return void
	 */
	public function boot() {
		(new Setting)->loadModel();
		App::setLocale('vi');
		Schema::defaultStringLength(191);
		MenuController::render();
		//
	}

	/**
	 * Register any application services.
	 * @return void
	 */
	public function register() {
		//
	}
}

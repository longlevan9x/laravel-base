<?php

namespace App\Providers;

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
		//
	}

	/**
	 * Register any application services.
	 * @return void
	 */
	public function register() {
		if ($this->app->environment() !== 'production') {
			$this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
		}
	}
}

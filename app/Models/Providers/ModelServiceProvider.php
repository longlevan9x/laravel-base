<?php

namespace App\Models\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;


class ModelServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 * @return void
	 */
	public function register() {
		$this->app->singleton('setting', function() {
			return new Setting;
		});
	}
}

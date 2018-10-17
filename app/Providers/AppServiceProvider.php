<?php

namespace App\Providers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Http\Controllers\Menu\WebsiteMenu;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Document;
use App\Models\News;
use App\Models\Post;
use App\Models\Procedure;
use App\Models\Setting;
use Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;


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

		$this->composers();
	}

	public function composers() {

		view()->composer('website.*', function($view) {
			/** @var View $view */
		});
		view()->composer('admin.*', function($view) {
			/** @var View $view */
			if (auth()->check()) {
				$view->with('menusAdmin', Cache::remember('menusAdmin', 60, function() {
					return AdminMenu::getMenu();
				}));
			}
		});
	}
}

<?php

namespace App\Providers;

use App\Http\Controllers\Menu\AdminMenu;
use App\Models\Facade\SettingFacade;
use App\Models\Setting;
use Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;


class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 * @return void
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function boot() {
		(new Setting)->loadModel();
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
//		view()->composer('website.*', function($view) {
//			if (session()->has('website_locale')) {
//				App::setLocale(session('website_locale'));
//			}
//
//		});

		view()->composer('admin.*', function($view) {
			$old_locale = session()->get('admin_locale');

			$current_locale = SettingFacade::getLanguage();

			$cacheMenusAdminKey = 'menusAdmin' . (\Auth::user()->username ?? '');
			if ($old_locale != $current_locale) {
				Cache::delete($cacheMenusAdminKey);
			}

			App::setLocale($current_locale);
			session()->put('admin_locale', $current_locale);

			/** @var View $view */
			if (auth()->check()) {
				$view->with('menusAdmin', Cache::remember($cacheMenusAdminKey, 60, function() {
					return AdminMenu::getMenu();
				}));

				$notifications = [
					'contact' => ['title' => __('abilities.contact.name'), 'icon' => 'fa fa-bell', 'total' => 1, 'url' => url_admin('contact')],
					'comment' => ['title' => __('abilities.comment.name'), 'icon' => 'fa fa-bell', 'total' => 1, 'url' => url_admin('comment')]
				];
				$view->with('notifications', $notifications);
			}

			//share controller name to view
			$controller_name = '';
			if (isset(request()->route()->action)) {
				$action     = request()->route()->action;
				$controller = class_basename($action["controller"]);

				list($controller_name) = explode("@", $controller);
				$controller_name = strtolower(str_replace("Controller", '', $controller_name));
			}
			$view->with(compact("controller_name"));
		});
	}
}

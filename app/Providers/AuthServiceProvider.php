<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 * @var array
	 */
	protected $policies = [
		'App\Model'                    => 'App\Policies\ModelPolicy',
		"App\User"                     => "App\Policies\UserPolicy",
		"App\Models\Menu"               => "App\Policies\MenuPolicy",
		"App\Models\Category"          => "App\Policies\CategoryPolicy",
		"App\Models\Admins"            => "App\Policies\AdminPolicy",
		"Silber\Bouncer\Database\Role" => "App\Policies\RolePolicy",
		//can remove
	];

	/**
	 * Register any authentication / authorization services.
	 * @return void
	 */
	public function boot() {
		$this->registerPolicies();

		//
	}
}

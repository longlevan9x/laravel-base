<?php

namespace App\Http\Middleware;

use App\Commons\CConstant;
use App\Http\Controllers\Menu\AdminMenu;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @param string                    $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = CConstant::GUARD_ADMIN) {
		if (!Auth::guard($guard)->check()) {
			return redirect('admin/login');
		}
		AdminMenu::render();
		return $next($request);
	}
}

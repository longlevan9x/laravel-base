<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRole
{
	/**
	 * Handle an incoming request.
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @param                           $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = CConstant::GUARD_ADMIN) {
		if (!Auth::guard($guard)->check()) {
			return redirect('admin/login');
		}

		return $next($request);
	}
}

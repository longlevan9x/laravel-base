<?php

namespace App\Http\Controllers\Admin\AdminAuth;

use App\Commons\CConstant;
use App\Http\Controllers\Controller;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers, LogsoutGuard {
		LogsoutGuard::logout insteadof AuthenticatesUsers;
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm()
	{
		return view('admin.auth.login');
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard()
	{
		return Auth::guard(CConstant::GUARD_ADMIN);
	}

	/**
	 * change column login
	 * @return string
	 */
	public function username() {
		return 'username';
	}

	/**
	 * @return string
	 */
	public function logoutToPath() {
		return 'admin/login';
	}

	/**
	 * @param Request $request
	 */
	protected function sendFailedLoginResponse(Request $request) {
		throw ValidationException::withMessages([
			$this->username() => [__("auth.the username or password not correct.")],
		]);
	}
}

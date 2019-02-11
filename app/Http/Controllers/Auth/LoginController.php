<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
		view()->share('current_method', 'index');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
	 * @throws ValidationException
	 */
	public function login(Request $request) {
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {
			if (auth()->user()->is_active == 0) {
				$this->logout($request);

				return redirect('login')->withInput()->withErrors(['email' => 'Your account is inactive. Click on the activation link sent to your account  to activate it']);
			}

			return $this->sendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	/**
	 * @return string
	 */
	protected function guard() {
		return \Auth::guard('web');
	}
}

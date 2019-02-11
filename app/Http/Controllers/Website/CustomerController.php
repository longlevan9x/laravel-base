<?php

namespace App\Http\Controllers\Website;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Website
 */
class CustomerController extends Controller
{
	/**
	 * CustomerController constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->prefixBreadcrumb = __('auth.account_info');
		$this->getBreadcrumb();
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showProfile() {
		$user = Auth::user();

		return view('website.customer.profile', compact('user'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function postProfile(Request $request) {
		$user = Auth::user();
		$user->fill($request->except('email'));
		$user->save();

		return redirect('customer/profile');
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showChangePassword() {
		return view('website.customer.change-password');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function postChangePassword(Request $request) {
		$validator = $this->validatorPassword($request->all());
		if ($validator->fails()) {
			return redirect()->route('customer.change-password')->withErrors($validator);
		}
		$user = Auth::user();

		if (Hash::check($request->post('password_current'), $user->password)) {
			$user->password = $request->post('password_new');
			$user->save();
		}
		else {
			return redirect()->route('customer.change-password')->with('password_current', __('passwords.password_old_not_match'));
		}

		return redirect('customer/change-password')->with('password_success', __('passwords.success'));
	}

	/**
	 * @param array $data
	 * @return \Illuminate\Validation\Validator
	 */
	private function validatorPassword(array $data) {
		return Validator::make($data, [
			'password_current' => 'required|string|min:6',
			'password_new'     => 'required|min:6',
			'password_confirm' => 'required|string|min:6|same:password_new',
		]);
	}
}

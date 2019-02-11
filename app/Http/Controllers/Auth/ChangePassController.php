<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ChangePassController
 * @package App\Http\Controllers\Auth
 */
class ChangePassController extends Controller
{
	/**
	 * ChangePassController constructor.
	 */
	public function __construct() {
		$this->middleware('guest');
		view()->share('current_method', 'index');
	}

	/**
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
	 */
	private function validator(array $data) {
		return Validator::make($data, [
			'current_pass' => 'required|string|min:6',
			'password'     => 'required|min:6|same:password',
			're-password'  => 'required|string|min:6|same:password',
		]);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showChangePassword() {
		return view('auth.passwords.change-pass');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function changePassword(Request $request) {
		$user_id      = Auth::user()->id;
		$current_pass = $request->input('current_pass');
		if (Hash::check($current_pass, Auth::user()->password)) {
			$validator = $this->validator($request->all());
			if ($validator->fails()) {
				return redirect()->route('show-change-pass')->withErrors($validator)->withInput();
			}
			else {
				$user           = User::find($user_id);
				$user->password = Hash::make($request->password);
				$user->save();

				return view('auth.login')->with('message', 'Change password success');
			}
		}
		else {
			return view('auth.passwords.change-pass')->with('message', 'Current password not correct');
		}
	}
}

<?php

namespace App\Http\Controllers\Auth;

use App\Commons\CConstant;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
	/**
	 * @param $email
	 * @param $authen_key
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function verification($email, $authen_key) {
		$user = User::whereEmail($email)->firstOrFail();
		if (isset($user)) {
			if (!empty($user->authen_key)) {
				if ($user->authen_key == $authen_key) {
					if (base64_decode($user->authen_key) > time()) {
						$user->is_active  = CConstant::STATE_ACTIVE;
						$user->authen_key = null;
						$user->save();

						return redirect('/')->with('message', 'verification success');
					}
					return redirect('/')->with('message', 'verification fail. key expired');
				}
				else {
					return redirect('/')->with('message', 'email not exist');
				}
			}
			else {
				return redirect('/')->with('message', 'email verified');
			}
		}

		return redirect('/')->with('message', 'email not exist');
	}
}

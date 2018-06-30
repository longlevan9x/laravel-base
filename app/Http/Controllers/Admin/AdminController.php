<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Commons\Facade\CUser;
use App\Http\Requests\AdminRequest;
use App\Models\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show_profile() {
		return view('admin.admin.profile');
	}

	/**
	 * @param AdminRequest $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function update_profile(AdminRequest $request) {
		$user          = CUser::userAdmin();
		$old_image     = $user->image;
		$admin_request = $request->all();
		$image         = CFile::upload('image', CUser::getTableName(Admins::class), $old_image);

		$admin_request['image'] = $image;
		$user->fill($admin_request)->update();

		return redirect(url_admin('profile'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function change_password(Request $request) {
		$validation = $this->validate($request, ['password' => 'required|confirmed|min:6']);
		if ($validation) {
			$user = CUser::userAdmin();

			$user->password = Hash::make($request->password);
			$user->setRememberToken(Str::random(60));
			$user->save();

			return redirect(url_admin('profile#tab_content2'))->with('success', __("Change password success"));
		}
	}
}

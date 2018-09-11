<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Commons\Facade\CUser;
use App\Http\Requests\AdminRequest;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
	protected $_role = [Admins::ROLE_SUPER_ADMIN, Admins::ROLE_ADMIN, Admins::ROLE_MANAGEMENT];

	public function __construct() {
		parent::__construct();
		if (!in_array($this->getCurrentMethod(), ['show_profile', 'update_profile', 'change_password'])) {
			$this->setRoleExcept(Admins::ROLE_AUTHOR);
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show_profile() {
		$model = CUser::userAdmin();
		$model->setMaxImageWidth(220);
		$model->setMaxImageHeight(200);

		return view('admin.admin.profile', compact('model'));
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
	 * @throws \Exception
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

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Admins::where('id', '<>', CUser::userAdmin()->id)->where('role', "<", CUser::userAdmin()->role)
		                ->get();

		return view('admin.admin.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$model = new Admins;

		return view('admin.admin.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param AdminRequest $request
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function store(AdminRequest $request) {
		$model = new Admins;
		$model->fill($request->all());
		$model->generatePassword();
		$model->setAuthor_id();
		$model->save();

		//Store::create($request->all());
		return redirect(self::getUrlAdmin());
	}

	/**
	 * Display the specified resource.
	 * @param Admins $admin
	 * @return \Illuminate\Http\Response
	 */
	public function show(Admins $admin) {
		$model = $admin;

		return view('admin.admin.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Admins $admin
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Admins $admin) {
		$model = $admin;

		return view('admin.admin.update', compact('model'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param AdminRequest $request
	 * @param Admins       $admin
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function update(AdminRequest $request, Admins $admin) {
		$admin->fill($request->all());
		$admin->generatePassword();
		$admin->setAuthor_id();
		$admin->save();

		return redirect(self::getUrlAdmin());
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Admins $admin
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function destroy(Admins $admin) {
		if ($admin->delete()) {
			return redirect(self::getUrlAdmin());
		}

		return redirect(self::getUrlAdmin())->with('error', "Delete Fail");
	}
}

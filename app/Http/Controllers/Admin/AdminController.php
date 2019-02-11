<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Commons\Facade\CUser;
use App\Http\Requests\AdminRequest;
use App\Models\Admins;
use Bouncer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
	protected $roles = [];

	public function __construct() {
		parent::__construct();
		$this->roles = Bouncer::Role()->pluck('name', 'id');
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
		$this->before(__FUNCTION__);
		$models = Admins::where('id', '<>', CUser::userAdmin()->id)->where('role', ">", CUser::userAdmin()->role)->get();

		return view('admin.admin.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = new Admins;
		$roles = $this->roles;

		return view('admin.admin.create', compact('model', 'roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param AdminRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(AdminRequest $request) {
		$this->before(__FUNCTION__);
		$model = new Admins;
		$model->fill($request->all());
		//$model->generatePassword();
		//$model->setAuthor_id();
		$check = $model->save();
		$model->roles()->sync($request->role);

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $model);
	}

	/**
	 * Display the specified resource.
	 * @param Admins $admin
	 * @return \Illuminate\Http\Response
	 */
	public function show(Admins $admin) {
		$this->before(__FUNCTION__);
		$model = $admin;

		return view('admin.admin.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Admins $admin
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Admins $admin) {
		$this->before(__FUNCTION__);
		$model = $admin;
		$roles = $this->roles;

		return view('admin.admin.update', compact('model', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param AdminRequest $request
	 * @param Admins       $admin
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function update(AdminRequest $request, Admins $admin) {
		$this->before(__FUNCTION__);
		$admin->fill($request->all());
		//$admin->generatePassword();

		$check = $admin->save();
		$admin->roles()->sync($request->role);

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $admin);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Admins $admin
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function destroy(Admins $admin) {
		$this->before(__FUNCTION__);
		$check = $admin->delete();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $admin);
	}

	/**
	 * @return Admins|mixed
	 */
	public function getModel() {
		return new Admins();
	}
}

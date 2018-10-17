<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admins;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 * @property Setting $model
 */
class SettingController extends Controller
{
	public $model;

	public function __construct(Setting $model) {
		$this->model = $model;
		parent::__construct();
		$this->setRoleExcept(Admins::ROLE_AUTHOR);
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$model = Setting::getModel();
		return view('admin.setting.index', compact('model'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function store(Request $request) {
		$this->model->setModel($request);
		$check = $this->model->save();

		return $this->redirectWithModel(url_admin('setting'), $check, $this->model);
	}
}

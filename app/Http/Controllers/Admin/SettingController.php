<?php

namespace App\Http\Controllers\Admin;

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
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index() {
		$model = Setting::getModel();

		return view('admin.setting.index', compact('model'));
	}

	public function store(Request $request) {
		$this->model->setModel($request);
		$this->model->save();

		return redirect(url_admin('setting'));
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admins;
use App\Models\Facade\SettingFacade;
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
		$model = SettingFacade::prepareKeyValues($request->all(), ['autoload' => 1]);
		$model->prepareKeyValueUploads([config('common.settings.keys._background_login')], ['autoload' => 1])->saveModel();

		return $this->redirectWithMessage(url_admin('setting'), $model, __("admin.update"). " " .  __('message.success'), __("admin.update"). " " .  __('message.error'));
	}
}

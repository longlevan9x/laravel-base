<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admins;
use App\Models\Facade\SettingFacade;
use App\Models\Post;
use App\Models\Setting;
use Cache;
use Illuminate\Http\Request;
use function MicrosoftAzure\Storage\Samples\deleteDirectory;

class WebsiteController extends Controller
{
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.website-message');
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function showConfig() {
		$this->setRoleExcept(Admins::ROLE_AUTHOR);
		$this->checkRole();
		$model = SettingFacade::loadModelByKey();
		$model->setMaxLogoWidth(107);
		$model->setMaxLogoHeight(48);

		return view('admin.website.config', compact('model'));
	}

	public function postConfig(Request $request) {
		$this->setRoleExcept(Admins::ROLE_AUTHOR);
		$this->checkRole();
		$model = SettingFacade::prepareKeyValues($request->all(), ['autoload' => 1]);
		$model->prepareKeyValueUploads([Setting::KEY_LOGO, 'website_image'], ['autoload' => 1])->saveModel();

		return $this->redirectWithMessage(url(self::getConfigUrlAdmin('config')), $model, ['Cập nhật thành công', 'Cập nhật thất bại']);
	}

	public function showMessage() {
		$model = SettingFacade::loadModelByKey();

		return view('admin.website.message', compact('model'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function postMessage(Request $request) {
		$model = SettingFacade::setKeyFillable(Setting::KEY_MESSAGE_ORDER, Setting::KEY_MESSAGE_ORDER_SUCCESS, Setting::KEY_MESSAGE_ORDER_FAIL);
		$model->prepareValue($request->all())->saveModel();

		return $this->redirectWithMessage(url(self::getConfigUrlAdmin('message')), $model, ['Cập nhật thành công', 'Cập nhật thất bại']);

	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showVideo() {
		$model = SettingFacade::loadModelByKey(['_video']);

		return view('admin.website.video', compact('model'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function postVideo(Request $request) {
		$model = SettingFacade::prepareKeyValues($request->all(), ['autoload' => 1])->saveModel();

		return $this->redirectWithMessage(url(self::getConfigUrlAdmin('video')), $model, ['Cập nhật thành công', 'Cập nhật thất bại']);
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function refreshCache() {
		Cache::flush();

		return redirect()->back()->with('success', "Refresh Cache");
	}
}

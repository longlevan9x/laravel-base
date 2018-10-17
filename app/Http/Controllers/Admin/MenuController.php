<?php

namespace App\Http\Controllers\Admin;

use App\Commons\CConstant;
use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MenuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Menu::query()->orderBySortOrder()->get();
		$model  = new Menu;

		return view('admin.menu.index', compact('models', 'model'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$model = new Menu;

		return view('admin.menu.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MenuRequest $request
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function store(MenuRequest $request) {
		return redirect(self::getUrlAdmin());
		$model = new Menu;
		$model->fill($request->all());
		$model->save();

		return redirect(self::getUrlAdmin());
	}

	/**
	 * Display the specified resource.
	 * @param Menu $menu
	 * @return \Illuminate\Http\Response
	 */
	public function show(Menu $menu) {
		$model = $menu;

		return view('admin.menu.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Menu $menu
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Menu $menu) {
		$models = Menu::query()->orderBySortOrder()->get();
		$model  = $menu;

		return view('admin.menu.index', compact('models', 'model'));

		//		return view('admin.menu.update', compact('model'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param Menu    $menu
	 * @return RedirectResponse|Redirector
	 * @throws \Exception
	 */
	public function update(Request $request, Menu $menu) {
		$menu->fill($request->all());
		$urls      = config('common.menu.url');
		$menu->url = $urls[$menu->type];
		$menu->save();

		return redirect(self::getUrlAdmin());
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Menu $menu
	 * @return RedirectResponse|Redirector
	 * @throws \Exception
	 */
	public function destroy(Menu $menu) {
		$check = $menu->delete();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $menu);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showSortOrder() {
		$models = Menu::all();

		return view('admin.menu.sort_order', compact('models'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function postSortOrder(Request $request) {
		$data = [];
		foreach ($request->items as $key => $item) {
			$menu             = Menu::whereId($item)->first();
			$menu->sort_order = $key;
			$menu->save();
		}

		return responseJson(CConstant::STATUS_SUCCESS);
	}
}

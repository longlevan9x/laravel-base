<?php

namespace App\Http\Controllers\Admin;

use App\Commons\CConstant;
use App\Http\Requests\MenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MenuController extends Controller
{
	/**
	 * MenuController constructor.
	 * @param Menu $menu
	 */
	public function __construct(Menu $menu) {
		$this->model = $menu;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = Menu::query()->orderBySortOrder()->get();
		$model  = new Menu;

		return view('admin.menu.index', compact('models', 'model'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = new Menu;

		return view('admin.menu.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param MenuRequest $request
	 * @return RedirectResponse|Redirector
	 * @throws \Exception
	 */
	public function store(MenuRequest $request) {
		$this->before(__FUNCTION__);

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
		$this->before(__FUNCTION__);
		$model = $menu;

		return view('admin.menu.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Menu $menu
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Menu $menu) {
		$this->before(__FUNCTION__);
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
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function update(Request $request, Menu $menu) {
		$this->before(__FUNCTION__);
		$menu->fill($request->all());
		$urls = config('common.menu.url');
		//$menu->url = $urls[$menu->type];
		$menu->save();
		$this->cacheFlush();

		return redirect(self::getUrlAdmin());
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Menu $menu
	 * @return RedirectResponse|Redirector
	 * @throws \Exception
	 */
	public function destroy(Menu $menu) {
		$this->before(__FUNCTION__);
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
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function postSortOrder(Request $request) {
		$data = [];
		foreach ($request->items as $key => $item) {
			$menu             = Menu::whereId($item)->first();
			$menu->sort_order = $key;
			$menu->save();
		}
		$this->cacheFlush();

		return responseJson(CConstant::STATUS_SUCCESS);
	}

	/**
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	protected function cacheFlush() {
		Cache::delete(config('common.cache.keys.website.menus'));
	}
}

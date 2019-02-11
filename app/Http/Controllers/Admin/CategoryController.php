<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	protected $type;

	/**
	 * CategoryController constructor.
	 * @param Category $category
	 */
	public function __construct(Category $category) {
		parent::__construct();
		$this->model = $category;
		$type        = $this->type = request('type', Category::TYPE_CATEGORY);
		view()->share(compact('type'));
	}

	/**
	 * @param $type
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function type($type) {
		$models = Category::whereType($this->type)->withTranslation()->get();

		return view('admin.category.index', compact('models'));
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = Category::whereType($this->type)->withTranslation()->get();

		return view('admin.category.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = new Category;

		return view('admin.category.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param CategoryRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CategoryRequest $request) {
		$this->before(__FUNCTION__);
		$model = new Category;
		$model->fill($request->all());
		$check = $model->save();

		$params = ['type', $this->type];
		$this->cacheFlush();

		return $this->redirectWithModel(self::getUrlAdmin($params), $check, $model);
	}

	/**
	 * Display the specified resource.
	 * @param Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category) {
		$this->before(__FUNCTION__);
		$model = $category;

		return view('admin.category.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Category $category
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Category $category) {
		$this->before(__FUNCTION__);
		$model = $category;

		view()->share('type', $category->type);

		return view('admin.category.update', compact('model'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param CategoryRequest $request
	 * @param Category        $category
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function update(CategoryRequest $request, Category $category) {
		$this->before(__FUNCTION__);
		$category->fill($request->all());
		$check  = $category->save();
		$params = ['type', $category->type];

		$this->cacheFlush();

		return $this->redirectWithModel(self::getUrlAdmin($params), $check, $category);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Category $category
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function destroy(Category $category) {
		$this->before(__FUNCTION__);
		$check  = $category->delete();
		$params = ['type', $category->type];
		$this->cacheFlush();

		return $this->redirectWithModel(self::getUrlAdmin($params), $check, $category);
	}

	public function getOptionCategoryWithType(Request $request) {
		$models = Category::getCategoryByParent($request->id, $request->type);

		return view('admin.category.option', compact('models'));
	}

	public function cacheFlush() {
		\Cache::delete(config('common.cache.keys.products.productCategories'));
		\Cache::delete(config('common.cache.keys.website.menus'));
	}
}

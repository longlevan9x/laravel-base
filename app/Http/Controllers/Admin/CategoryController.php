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
		$type        = $this->type = request()->query('type', Category::TYPE_CATEGORY);
		view()->share(compact('type'));
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Category::query()->get();

		return view('admin.category.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$model = new Category;

		return view('admin.category.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param CategoryRequest $request
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function store(CategoryRequest $request) {
		$model = new Category;
		$model->fill($request->all());
		$check = $model->save();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $model);
	}

	/**
	 * Display the specified resource.
	 * @param Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category) {
		$model = $category;

		return view('admin.category.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Category $category
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Category $category) {
		$model = $category;

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
		$category->fill($request->all());
		$check = $category->save();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $category);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Category $category
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function destroy(Category $category) {
		$check = $category->delete();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $category);
	}

	public function getOptionCategoryWithType(Request $request) {
		$models = Category::getCategoryByParent($request->id, $request->type);

		return view('admin.category.option', compact('models'));
	}
}

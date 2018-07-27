<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Category::whereType(Category::TYPE_CATEGORY)->get();

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
		$model->type = Category::TYPE_CATEGORY;
		$model->save();

		//Store::create($request->all());
		return redirect(self::getUrlAdmin());
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
		$category->save();

		return redirect(self::getUrlAdmin());
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Category $category
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function destroy(Category $category) {
		if ($category->delete()) {
			return redirect(self::getUrlAdmin());
		}

		return redirect(self::getUrlAdmin())->with('error', "Delete Fail");
	}

	public function getOptionCategoryWithType(Request $request) {
		$models = Category::getCategoryByParent($request->id, $request->type);

		return view('admin.category.option', compact('models'));
	}
}

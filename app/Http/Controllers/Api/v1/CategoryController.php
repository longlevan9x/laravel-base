<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api\v1
 */
class CategoryController extends Controller
{
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index() {
		$models = Category::active()->get();

		return responseJson('success', $models, 200);
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function showBySlug($slug) {
		$model = Category::findBySlugOrFail($slug);
		if (isset($model)) {
			return responseJson('success', $model, 200);
		}

		return responseJson('fail', __('admin/common.not found'), 200);
	}
}

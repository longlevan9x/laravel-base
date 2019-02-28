<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pika\Api\QueryBuilder;
use Pika\Api\RequestCreator;

class PostController extends Controller
{
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function index(Request $request) {
    	$queryBuilder = new QueryBuilder(new Post, $request);
    	return responseJson("success", $queryBuilder->build()->paginate(), 200);
    }

	/**
	 * @param $slug
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getBySlug($slug) {
		$model = Post::findBySlugOrFail($slug);
	    if (isset($model)) {
		    return responseJson('success', $model, 200);
	    }

	    return responseJson('fail', __('admin/common.not found'), 200);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function postTop(Request $request) {
		$limit = $request->get('limit', 3);
		$columns = $request->get('columns', '*');
		$columns = explode(',', $columns);
		if (empty($columns)) {
			$columns = ["*"];
		}
		$models = Post::select($columns)->active()->with(['category:id,name,slug'])->limit($limit)->latest()->get();
	    return responseJson("success", $models, 200);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function postPopular(Request $request) {
	    $order_by = $request->get('order_by', "created_at, desc");
	    list($column, $direction) = explode(",", $order_by);

		$limit = $request->get('limit', 6);
		$columns = $request->get('columns', '*');
		$columns = explode(',', $columns);
		if (empty($columns)) {
			$columns = ["*"];
		}

	    $models = Post::select($columns)->active()->with(['category:id,name,slug'])->limit($limit)->orderBy($column, $direction)->get();
	    return responseJson("success", $models, 200);
    }
}

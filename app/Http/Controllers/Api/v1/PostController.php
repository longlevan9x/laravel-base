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
}

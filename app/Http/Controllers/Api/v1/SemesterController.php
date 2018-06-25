<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/24/2018
 * Time: 9:22 AM
 */

namespace App\Http\Controllers\Api\v1;


use App\Commons\CConstant;
use App\Http\Controllers\Admin\Controller;
use App\Models\Semester;

/**
 * Class SemesterController
 * @package App\Http\Controllers\Api\v1
 */
class SemesterController extends Controller
{
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index() {
		$models = Semester::all();
		if( ! isset($models) || empty($models)) {
			return response()->json([
				'message' => 'student not found',
				'status'  => 404,
				'result'  => $models
			], 404);
		}

		return response()->json([
			'message' => CConstant::STATUS_SUCCESS,
			'status'  => 200,
			'result'  => $models
		], 200);
	}

	public function show(Semester $semester) {
		if( ! isset($semester) || empty($semester)) {
			return response()->json([
				'message' => 'student not found',
				'status'  => 404,
				'result'  => $semester
			], 404);
		}

		return responseJson(CConstant::STATUS_SUCCESS, $semester, 200);
	}
}
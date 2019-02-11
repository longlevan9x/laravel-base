<?php

namespace App\Http\Controllers\Admin;

use App\Commons\CConstant;
use App\Commons\Facade\CFile;
use App\Models\Setting;
use App\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
	/**
	 * @param $table
	 * @param $key
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteFile($table, $key, $id = 0) {
		/** @var Model|ModelTrait $model */
		$model = DB::table($table)->where('id', $id)->first();
		if (isset($model) && !empty($model)) {
			if (key_exists('path', $model) && !empty($model->path)) {
				$folder = $model->path;
			}
			else {
				$folder = $table;
			}

			if (filter_var($model->{$key}, FILTER_VALIDATE_URL)) {
				DB::table($table)->where('id', $id)->update([$key => '']);

				return responseJson(CConstant::STATUS_SUCCESS);
			}

			if (CFile::removeFile($folder, $model->{$key})) {
				DB::table($table)->where('id', $id)->update([$key => '']);

				return responseJson(CConstant::STATUS_SUCCESS);
			}

			return responseJson(1, [], 404);
		}
		else {
			$this->deleteFileSetting($table, $key);

			return responseJson(CConstant::STATUS_SUCCESS);
		}

		return responseJson(1, [], 404);
	}

	/**
	 * @param $table
	 * @param $key
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteFileSetting($table, $key) {
		/** @var Setting $model */
		$model = DB::table($table)->where('key', $key)->first();

		$folder = $table;

		if (filter_var($model->value, FILTER_VALIDATE_URL)) {
			DB::table($table)->where('key', $key)->update(['value' => '']);

			return responseJson(CConstant::STATUS_SUCCESS);
		}

		if (CFile::removeFile($folder, $model->value)) {
			DB::table($table)->where('key', $key)->update(['value' => '']);

			return responseJson(CConstant::STATUS_SUCCESS);
		}

		return responseJson(1, [], 404);
	}

	/**
	 * @param Request $request
	 * @param string  $table
	 * @param string  $column
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function select2(Request $request, $table = '', $column = '') {
		$keyword    = $request->get('q');
		$conditions = $request->get('conditions');

		$results = DB::table($table)->selectRaw("id as id, $column as text")->where($column, 'LIKE', '%' . $keyword . '%');
		$results->where(function(Builder $query) use ($conditions) {
			foreach ($conditions as $index => $condition) {
				$query->where($index, $condition);
			}
		});

		$results = $results->get();

		return responseJson(CConstant::STATUS_SUCCESS, $results);
	}

	/**
	 * method show view with ajax
	 * @param int     $id
	 * @param  string $folder
	 * @param string  $classModel
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($id, $folder, $classModel) {
		/** @var ModelTrait|Model|Builder $model */
		$classModel = base64_decode($classModel);
		$model      = call_user_func([$classModel, 'query']);
		if (method_exists(new $classModel, 'translations')) {
			$model = $model->withTranslation()->where('id', $id)->first();
		}
		else {
			$model = $model->find($id);
		}
		if (isset($model)) {
			$view_file = 'admin.' . $folder . '.view';
			if (view()->exists($view_file)) {
				return view($view_file, compact('model'));
			}
			else {
				return view('admin.layouts.templates.view', compact('model'));
			}
		}
	}
}

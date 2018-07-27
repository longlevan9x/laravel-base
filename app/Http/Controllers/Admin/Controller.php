<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Models\Category;
use App\Models\Traits\ModelMethodTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class Controller
 * @package App\Http\Controllers\Admin
 */
class Controller extends \App\Http\Controllers\Controller
{
	public $model;

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function bulkDeleteAjax(Request $request) {
		$table = $request->table;
		$ids   = $request->ids;
		if (is_string($ids)) {
			$ids = explode(',', $ids);
		}

		if (empty($table)) {
			return responseJson('fail', 'table ' . __('admin/common.not found'));
		}

		if (empty($ids)) {
			return responseJson('fail', 'id ' . __('admin/common.not found'));
		}

		if (DB::table($table)->whereIn('id', $ids)->delete() > 0) {
			return responseJson('success');
		}

		return responseJson('fail');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function bulkDelete(Request $request) {
		$table = $request->table;
		$ids   = $request->ids;

		if (is_string($ids)) {
			$ids = explode(',', $ids);
		}

		if (empty($table)) {
			return redirect()->back()->with('fail', 'table ' . __('admin/common.not found'));
		}

		if (empty($ids)) {
			return redirect()->back()->with('fail', 'id ' . __('admin/common.not found'));
		}
		/** @var Model|ModelMethodTrait $model */
		$model = new $table;
		$model::whereIn('id', $ids)->get()->each(function($item, $index) {
			/** @var Model|ModelUploadTrait $item */
			if (key_exists('path', $item->getAttributes()) && !empty($item->path)) {
				$path = $item->path;
			} else {
				$path = $item->getTable();
			}
			$files = $item->getKeyImageUpload();
			foreach ($files as $k_f => $file) {
				CFile::removeFile($path, $item->{$file});
			}
		});

		if ($model::whereIn('id', $ids)->delete() > 0) {
			return redirect()->back()->with('success', __('message.delete success'));
		}

		return redirect()->back()->with('fail', __('message.delete fail'));
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Facade\CFile;
use App\Models\Traits\ModelMethodTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class Controller
 * @package App\Http\Controllers\Admin
 */
class Controller extends \App\Http\Controllers\Controller
{
	protected $guard = 'admin';
	/**
	 * @var
	 */
	public $model;
	/**
	 * @var \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	protected $user = null;

	/**
	 * Controller constructor.
	 */
	public function __construct() {
		$this->middleware(function($request, $next) {
			$this->user = Auth::user();
			/** @var Request $request */
			//			$this->user = $request->user($this->getGuard());

			return $next($request);
		});
	}

	/**
	 * @return mixed
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * @param mixed $model
	 */
	public function setModel($model): void {
		$this->model = $model;
	}

	/**
	 * @return null
	 */
	protected function getGuard() {
		return property_exists($this, 'guard') ? $this->guard : null;
	}

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
	 * @param      $action
	 * @param null $object
	 * @return bool
	 */
	protected function before($action, $object = null) {
		switch ($action) {
			case 'index':
			case 'show':
			case 'type':
				$action = 'index';
				break;
			case 'create':
			case 'store':
				$action = 'create';
				break;
			case 'edit':
			case 'update':
				$action = 'edit';
				break;
			case 'destroy':
				$action = 'destroy';
				break;
		}

		if (!$object) {
			$object = $this->getModel();
		}

		if ($this->user->cannot($action, $object)) {
			return abort(Response::HTTP_FORBIDDEN, __('repositories.text.forbiden_to_perform'));
		}

		return true;
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
			}
			else {
				$path = $item->getTable();
			}

			if (method_exists($item, 'getKeyImageUpload')) {
				$files = $item->getKeyImageUpload();
				foreach ($files as $k_f => $file) {
					CFile::removeFile($path, $item->{$file});
				}
			}
		});

		if ($model::whereIn('id', $ids)->delete() > 0) {
			return redirect()->back()->with('success', __('message.delete success'));
		}

		return redirect()->back()->with('fail', __('message.delete fail'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function bulk(Request $request) {
		$table = $request->table;
		$key   = $request->key;
		$value = $request->value;
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

		if ($model::whereIn('id', $ids)->update([$key => $value]) > 0) {
			return redirect()->back()->with('success', __('message.update success'));
		}

		return redirect()->back()->with('fail', __('message.update fail'));
	}

	/**
	 * phuong thuc dung de dieu huong va tra ve message
	 * $message co the truyen vao la 1 object Model hoac 1 mang message cua success va error
	 * neu message la mang success va error
	 * @param              $to
	 * @param bool         $check
	 * param message can is Model or messages
	 * @param array|object $message
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	protected function redirectWithMessage($to = null, $check = false, ...$message) {
		$current_method = $this->getCurrentMethod();
		$current_method = in_array($current_method, ['store', 'update', 'destroy']) ? __('admin.' . $current_method) : $current_method;
		if ($check) {
			$mess = ($message[0] ?? $current_method);
			$type = 'success';
		}
		else {
			$mess = ($message[1] ?? $current_method);
			$type = 'error';
		}

		return redirect($to, 302, [], null)->with($type, $mess);
	}

	/**
	 * @param null $to
	 * @param bool $check
	 * @param null $model
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function redirectWithModel($to = null, $check = false, $model = null) {
		$obj = $model;

		if ($model == null) {
			$obj = $this->getModel();
		}

		$text = '';
		if ($obj instanceof Model) {
			/** @var ModelTrait $obj */
			$text = $obj->{$obj->fieldSlugable()} ?? '';
		}

		$current_method = $this->getCurrentMethod();
		$current_method = in_array($current_method, ['store', 'update', 'destroy']) ? __('admin.' . $current_method) : $current_method;
		if ($check) {
			$mess = $current_method . " " . $text;
			$type = 'success';
		}
		else {
			$mess = $current_method . " " . $text;
			$type = 'error';
		}

		return redirect($to, 302, [], null)->with($type, $mess);
	}
}

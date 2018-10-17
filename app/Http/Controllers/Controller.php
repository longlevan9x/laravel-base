<?php

namespace App\Http\Controllers;

use App\Commons\Facade\CUser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * @return mixed
	 */
	public static function getClassName() {
		$class = static::class;
		$class = explode('\\', $class);

		return end($class);
	}

	/**
	 * @param string $prefix
	 * @return string
	 */
	public static function getResourceName($prefix = '') {
		$class    = self::getClassName();
		$resource = str_replace('Controller', '', $class);
		$resource = snake_case($resource, '-');

		if (!empty($prefix)) {
			$resource = "$resource/$prefix";
		}

		return strtolower($resource);
	}

	/**
	 * @param        $action
	 * @param string $prefix
	 * @return string
	 */
	public static function getControllerWithAction($action, $prefix = '') {
		$action = self::getClassName() . "@" . $action;
		if (!empty($prefix)) {
			$action = "$prefix\\$action";
		}

		return $action;
	}

	/**
	 * @param string $route
	 * @return string
	 */
	public static function getAdminRouteName($route = 'index') {
		return self::getRouteName('', $route);
	}

	/**
	 * @param string $prefix
	 * @param string $route
	 * @return string
	 */
	public static function getRouteName($prefix = '', $route = 'index') {
		$routeName = '';
		if (!empty($prefix)) {
			$routeName = $prefix . '.';
		}

		$routeName .= self::getResourceName();


		if (!empty($route)) {
			$routeName .= '.' . $route;
		}

		return $routeName;
	}

	/**
	 * @param mixed $parameters
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function getUrlAdmin($parameters = null) {
		return url('admin/' . self::getResourceName(), $parameters);
	}

	/**
	 * @param string $action
	 * @param null   $parameters
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function getConfigUrlAdmin($action = '', $parameters = null) {
		$path = 'admin/' . self::getResourceName();
		if (!empty($action)) {
			$path .= "/$action";
		}

		return url($path, $parameters);
	}

	/**
	 * @param $id
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function getEditUrlAdmin($id) {
		$params = [$id, 'edit'];

		return self::getUrlAdmin($params);
	}

	/**
	 * @return string
	 */
	public function getCurrentMethod() {
		$action = Route::currentRouteAction();
		$action = substr($action, strpos($action, '@') + 1);
		if (!$action) {
			return '';
		}

		return $action;
	}

	/**
	 * @param $model
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public static function getUrlAdminWithModel($model) {
		return self::getUrlAdmin(isset($model) ? $model->id : '');
	}
}

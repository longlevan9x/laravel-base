<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 12:48 PM
 */

if (!function_exists('url_admin')) {
	/**
	 * @param string $path
	 * @param array  $parameters
	 * @param null   $secured
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	function url_admin($path = '', $parameters = [], $secured = null) {
		$locale = get_locale();
		if (!empty($locale)) {
			return url("$locale/admin/$path", $parameters, $secured);
		}

		return url("admin/$path", $parameters, $secured);
	}
}

if (!function_exists('url_admin_with_class')) {
	/**
	 * @param string               $classController
	 * @param string               $method
	 * @param array|string|integer $parameters
	 * @return mixed
	 */
	function url_admin_with_class($classController, $method, ...$parameters) {
		return call_user_func([$classController, $method], $parameters);
	}
}

if (!function_exists('url_query')) {
	/**
	 * @param string $path
	 * @param array  $params
	 * @return string
	 */
	function url_query($path, $params = []) {
		$query = '';
		if (!empty($params)) {
			$query = "?" . http_build_query($params);
		}

		return url($path, [], null) . $query;
	}
}

if (!function_exists('url_admin_query')) {
	/**
	 * @param string $path
	 * @param array  $params
	 * @return string
	 */
	function url_admin_query($path, $params) {
		$query = '';
		if (!empty($params)) {
			$query = "?" . http_build_query($params);
		}

		return url_admin($path, [], null) . $query;
	}
}

if (!function_exists('get_locale')) {
	/**
	 * @return string
	 */
	function get_locale() {
		$locale = request()->segment(1);
		if (!in_array($locale, array_keys(config('common.language.locales')))) {
			$locale = '';
		}

		return $locale;
	}
}

if (!function_exists('url_locale')) {
	/**
	 * @param string $locale
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	function url_locale($locale = '') {
		$request = request();
		if ($locale == config('common.language.locale')) {
			return str_replace("/" . config('app.locale') . "/", "/", $request->getUri());
		}

		$pathInfo = str_replace("/" . config('app.locale') . "/", "/", $request->getPathInfo());

		return url_query("$locale" . $pathInfo, $request->all());
	}
}
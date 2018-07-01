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
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/25/2018
 * Time: 2:10 PM
 */

/**
 * file required at app/Helpers/index.php
 */

if (!function_exists('asset_css')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_css($path = '') {
		return asset('css/' . $path);
	}
}

if (!function_exists('asset_js')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_js($path = '') {
		return asset('js/' . $path);
	}
}

if (!function_exists('asset_vendor')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_vendors($path = '') {
		if (is_exist_path('vendors')) {
			return asset('vendors/' . $path);
		}

		return asset($path);
	}
}

if (!function_exists('asset_images')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_images($path = '') {
		if (is_exist_path('images')) {
			return asset('images/' . $path);
		}

		return asset($path);
	}
}

if (!function_exists('asset_uploads')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_uploads($path = '') {
		if (is_exist_path('uploads')) {
			return asset('uploads/' . $path);
		}

		return asset($path);
	}
}

if (!function_exists('asset_login')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_login($path = '') {
		return asset("login/$path");
	}
}
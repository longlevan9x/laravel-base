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

if (!function_exists('asset_admin_vendors')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_admin_vendors($path = '') {
		if (is_exist_path('admins/vendors')) {
			return asset_admin('vendors/' . $path);
		}

		return asset_admin($path);
	}
}

if (!function_exists('asset_admin_images')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_admin_images($path = '') {
		if (is_exist_path('admins/images')) {
			return asset_admin('images/' . $path);
		}

		return asset_admin($path);
	}
}

if (!function_exists('asset_admin_uploads')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function asset_admin_uploads($path = '') {
		if (is_exist_path('admins/uploads')) {
			return asset_admin('uploads/' . $path);
		}

		return asset_admin($path);
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

if (!function_exists('asset_admin')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_admin($path = '') {
		return asset("admins/$path");
	}
}

if (!function_exists('asset_app')) {
	/**
	 * @param $path
	 * @return string
	 */
	function asset_app($path = '') {
		return asset("app/$path");
	}
}

if (!function_exists('asset_app_css')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_app_css($path = '') {
		return asset_app("css/$path");
	}
}

if (!function_exists('asset_app_js')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function asset_app_js($path = '') {
		return asset_app("js/$path");
	}
}
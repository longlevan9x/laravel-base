<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/25/2018
 * Time: 2:27 PM
 */
/**
 * file required at app/Helpers/index.php
 */

if (!function_exists('public_path_css')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function public_path_css($path = '') {
		return public_path('css\\' . $path);
	}
}
if (!function_exists('public_path_js')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function public_path_js($path = '') {
		return public_path('js\\' . $path);
	}
}

if (!function_exists('public_path_vendor')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function public_path_vendor($path = '') {
		if (is_exist_path('vendor')) {
			return public_path('vendor\\' . $path);
		}

		return public_path($path);
	}
}

if (!function_exists('public_path_upload')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function public_path_upload($path = '') {
		if (is_exist_path('upload')) {
			return public_path('upload\\' . $path);
		}

		return public_path($path);
	}
}

if (!function_exists('public_path_images')) {
	/**
	 * @param string $path
	 * @return string
	 * @throws Exception
	 */
	function public_path_images($path = '') {
		if (is_exist_path('images')) {
			return public_path('images\\' . $path);
		}

		return public_path($path);
	}
}
/*store_path*/
if (!function_exists('storage_app_uploads')) {
	/**
	 * @param string $folder
	 * @param string $file
	 * @return string
	 */
	function storage_app_uploads ($folder = '', $file = '') {
		return storage_path("app\\uploads\\$folder\\$file");
	}
}


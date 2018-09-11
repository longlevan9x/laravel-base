<?php
/**
 * file required at app/Helpers/index.php
 */

if (!function_exists('setting')) {
	define('KEY_WEBSITE_NAME', 'website_name');
	define('KEY_WEBSITE_DESCRIPTION', 'website_description');
	define('KEY_ADMIN_EMAIL', 'admin_email');
	define('KEY_LANG_DEFAULT', 'lang_default');
	define('KEY_FORMAT_TIME', 'format_time');
	define('KEY_FORMAT_DATE', 'format_date');
	define('KEY_FORMAT_DATETIME', 'format_datetime');
	define('KEY_BLOG_CHARSET', 'blog_charset');
	define('KEY_LOGO', 'logo');

	/**
	 * @param string $key
	 * @param string $default_value
	 * @return mixed|string
	 * @throws Exception
	 */
	function setting($key, $default_value = '') {
		$value = \App\Models\Facade\SettingFacade::getValue($key);
		if (!isset($value) || empty($value)) {
			return $default_value;
		}

		return $value;
	}
}

if (!function_exists('is_exist_path')) {
	/**
	 * @param string $path
	 * @return bool
	 * @throws Exception
	 */
	function is_exist_path($path = '') {
		if (is_dir(public_path($path))) {
			return true;
		}
		throw  new Exception("Can't find $path folder");
	}
}

if (!function_exists('action_method_push_post')) {
	/**
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return string
	 */
	function action_method_push_post($model = null) {
		return isset($model) && !empty($model->getAttributes()) ? 'put' : 'post';
	}
}
if (!function_exists('public_path_admin')) {
	/**
	 * @param string $path
	 * @return string
	 */
	function public_path_admin($path = '') {
		return public_path("admin/$path");
	}
}
if (!function_exists('replace_multiple_space')) {
	/**
	 * @param        $str
	 * @param string $replacement
	 * @return null|string|string[]
	 */
	function replace_multiple_space($str, $replacement = " ") {
		return preg_replace('/\s+/', $replacement, $str);
	}
}

if (!function_exists("get_time_line")) {
	/**
	 * @param int|string $time
	 * @return false|int|string
	 */
	function get_time_line($time) {
		if (!is_numeric($time)) {
			$time = strtotime($time);
		}
		$now = time();

		$timeline = $now - $time;

		if ($timeline < 60 * 60) {
			return (int)($timeline / 60) . " minute ago";
		}
		elseif ($timeline < 60 * 60 * 24) {
			return (int)($timeline / 60 / 24) . " hour ago";
		}
		return (int) ($timeline / 60 / 60 / 24) . " day ago";

		return $timeline;
	}
}

if (!function_exists('responseJson')) {
	/**
	 * @param string $message
	 * @param mixed  $data
	 * @param int    $status
	 * @param array  $header
	 * @param int    $option
	 * @return \Illuminate\Http\JsonResponse
	 */
	function responseJson($message = '', $data = [], $status = 200, array $header = ['Content-type' => "application/json"], $option = JSON_NUMERIC_CHECK) {
		header("Content-type: application/application/json");

		return response()->json([
			'message' => $message,
			'status'  => $status,
			'result'  => $data
		], $status, $header, $option);
	}
}


/**
 * @param        $cs
 * @param string $delimiter
 * @param bool   $tolower
 * @return mixed|string
 */
function vn2latin($cs, $delimiter = '-', $tolower = true) {
	/* Mảng chứa tất cả ký tự có dấu trong Tiếng Việt */
	$marTViet = array(
		"à",
		"á",
		"ạ",
		"ả",
		"ã",
		"â",
		"ầ",
		"ấ",
		"ậ",
		"ẩ",
		"ẫ",
		"ă",
		"ằ",
		"ắ",
		"ặ",
		"ẳ",
		"ẵ",
		"è",
		"é",
		"ẹ",
		"ẻ",
		"ẽ",
		"ê",
		"ề",
		"ế",
		"ệ",
		"ể",
		"ễ",
		"ì",
		"í",
		"ị",
		"ỉ",
		"ĩ",
		"ò",
		"ó",
		"ọ",
		"ỏ",
		"õ",
		"ô",
		"ồ",
		"ố",
		"ộ",
		"ổ",
		"ỗ",
		"ơ",
		"ờ",
		"ớ",
		"ợ",
		"ở",
		"ỡ",
		"ù",
		"ú",
		"ụ",
		"ủ",
		"ũ",
		"ư",
		"ừ",
		"ứ",
		"ự",
		"ử",
		"ữ",
		"ỳ",
		"ý",
		"ỵ",
		"ỷ",
		"ỹ",
		"đ",
		"À",
		"Á",
		"Ạ",
		"Ả",
		"Ã",
		"Â",
		"Ầ",
		"Ấ",
		"Ậ",
		"Ẩ",
		"Ẫ",
		"Ă",
		"Ằ",
		"Ắ",
		"Ặ",
		"Ẳ",
		"Ẵ",
		"È",
		"É",
		"Ẹ",
		"Ẻ",
		"Ẽ",
		"Ê",
		"Ề",
		"Ế",
		"Ệ",
		"Ể",
		"Ễ",
		"Ì",
		"Í",
		"Ị",
		"Ỉ",
		"Ĩ",
		"Ò",
		"Ó",
		"Ọ",
		"Ỏ",
		"Õ",
		"Ô",
		"Ồ",
		"Ố",
		"Ộ",
		"Ổ",
		"Ỗ",
		"Ơ",
		"Ờ",
		"Ớ",
		"Ợ",
		"Ở",
		"Ỡ",
		"Ù",
		"Ú",
		"Ụ",
		"Ủ",
		"Ũ",
		"Ư",
		"Ừ",
		"Ứ",
		"Ự",
		"Ử",
		"Ữ",
		"Ỳ",
		"Ý",
		"Ỵ",
		"Ỷ",
		"Ỹ",
		"Đ",
		" "
	);
	/* Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên */
	$marKoDau = array(
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"a",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"e",
		"i",
		"i",
		"i",
		"i",
		"i",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"o",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"u",
		"y",
		"y",
		"y",
		"y",
		"y",
		"d",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"A",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"E",
		"I",
		"I",
		"I",
		"I",
		"I",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"O",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"U",
		"Y",
		"Y",
		"Y",
		"Y",
		"Y",
		"D",
		$delimiter
	);
	if ($tolower) {
		return strtolower(str_replace($marTViet, $marKoDau, $cs));
	}

	return str_replace($marTViet, $marKoDau, $cs);
}

if (!function_exists('get_root_name')) {
	/**
	 * @return mixed|string
	 */
	function get_root_name() {
		$path     = base_path();
		$path_arr = explode('/', $path);
		if (empty($path_arr) || count($path_arr) == 1) {
			$path_arr = explode('\\', $path);
		}

		if (!empty($path_arr)) {
			return end($path_arr);
		}

		return "";
	}
}
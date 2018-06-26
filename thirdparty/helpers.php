<?php
/**
 * file required at app/Helpers/index.php
 */

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

if (!function_exists('responseJson')) {
	function responseJson($message = '', $data = [], $status = 200, array $header = ['Content-type' => "application/json"], $option = JSON_NUMERIC_CHECK) {
		header("Content-type: application/application/json");

		return response()->json([
			'message' => $message, 'status' => $status, 'result' => $data
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
		"à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ",
		"ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ",
		"ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ",
		"đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ",
		"Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ",
		"Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ",
		"Ỹ", "Đ", " "
	);
	/* Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên */
	$marKoDau = array(
		"a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e",
		"e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
		"o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y",
		"d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E",
		"E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
		"O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y",
		"Y", "D", $delimiter
	);
	if ($tolower) {
		return strtolower(str_replace($marTViet, $marKoDau, $cs));
	}

	return str_replace($marTViet, $marKoDau, $cs);
}
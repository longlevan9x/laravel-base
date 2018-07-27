<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 4:54 PM
 */

namespace App\Commons;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

;

class CFile extends Common
{
	const DEFAULT_IMAGE_FOLDER = 'www';
	const DEFAULT_IMAGE_USER   = 'user.png';
	const DEFAULT_NO_IMAGE     = 'no_image.png';

	/**
	 * @var string
	 */
	public $errors;

	/**
	 * @param        $key
	 * @param string $folder
	 * @param string $old_file
	 * @return string|boolean
	 */
	public function upload($key, $folder = '', $old_file = '') {
		if (request()->has($key)) {
			/** @var UploadedFile $file */
			$file = request()->file($key);
			$name = time() . "_" . $file->getClientOriginalName();
			$save = $file->storeAs($folder, $name);
			if (!$save) {
				$this->errors = $file->getErrorMessage();

				return false;
			}
			if (!empty($old_file)) {
				$this->removeFile($folder, $old_file);
			}

			return $name;
		}
		if (!empty($old_file)) {
			return $old_file;
		}

		return '';
	}

	/**
	 * @param        $folder
	 * @param string $file
	 * @return bool
	 */
	public function removeFile($folder, $file) {
		$file_path = storage_app_uploads($folder, $file);
		if (file_exists($file_path) && !is_dir($file_path)) {
			return unlink($file_path);
		}

		return false;
	}

	/**
	 * @param        $folder
	 * @param        $image
	 * @param string $default_image
	 * @return mixed
	 */
	public function getImageUrl($folder, $image, $default_image = self::DEFAULT_NO_IMAGE) {
		if (filter_var($folder, FILTER_VALIDATE_URL)) {
			return $folder;
		}

		if (filter_var($image, FILTER_VALIDATE_URL)) {
			return $image;
		}

		$image_path = storage_app_uploads($folder, $image);
		$image_path = str_replace("\\", "/", $image_path);
		if (file_exists($image_path) && !is_dir($image_path)) {
			return Storage::url($folder . '/' . $image);
		}

		if (empty($default_image)) {
			return '';
		}

		return Storage::url(self::DEFAULT_IMAGE_FOLDER . "/$default_image");
	}

	/**
	 * @return mixed
	 */
	public function getErrors() {
		return $this->errors;
	}

	/**
	 * @param mixed $errors
	 */
	public function setErrors($errors) {
		$this->errors = $errors;
	}
}
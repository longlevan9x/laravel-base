<?php

namespace App\Models\Traits;

use App\Commons\Facade\CFile;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 06/30/2018
 * Time: 23:21
 */

/**
 * Trait ModelTrait
 * @package App\Models\Traits
 * @property Model $this
 */
trait ModelTrait
{
	use Sluggable;

	/**
	 * set auto upload image in method save
	 * @var bool
	 */
	public $auto_upload_image = true;

	/**
	 * @return string
	 */
	public function fieldSlug() {
		return "slug";
	}
	/**
	 * @return string
	 */
	public function fieldSlugable() {
		return '';
	}

	/**
	 * @return array
	 */
	public function sluggable(): array {
		$attribute = $this->getAttribute($this->fieldSlug());
		if (isset($attribute)) {
			return [
				$this->fieldSlug() => [
					'source' =>  $this->fieldSlugable()
				]
			];
		}
		return [];
	}

	/**
	 * @param array $options
	 * @return bool
	 * @throws \Exception
	 */
	public function save(array $options = []) {
		if (method_exists($this, 'uploadImage') && $this->isAutoUploadImage()) {
			$this->uploadImage();
		}
		$save = parent::save($options);
		if (!$save) {
			if (method_exists($this, 'removeImage') && $this->isAutoUploadImage()) {
				$this->removeImage();
			}

			return false;
		}

		return $save;
	}

	/**
	 * @return bool
	 */
	public function isAutoUploadImage() {
		return $this->auto_upload_image;
	}

	/**
	 * @param bool $auto_upload_image
	 */
	public function setAutoUploadImage($auto_upload_image) {
		$this->auto_upload_image = $auto_upload_image;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function getIsActiveLabel() {
		$attribute = $this->getAttribute('is_active');
		if (isset($attribute)) {
			return view('admin.layouts.widget.labels.active', ['slot' => $this->is_active]);
		}
		return "";
	}

	public function showImage($key = '') {
		$attribute = $this->getAttribute('is_active');
		if (isset($attribute)) {
			return view('admin.layouts.widget.image.show', ['src' => $this->getImagePath('', $key)]);
		}
		return "";
	}
}
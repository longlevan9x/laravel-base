<?php

namespace App\Models\Traits;

use App\Commons\Facade\CFile;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
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
 * @property Model  $this
 * @property int    id
 * @property string slug
 * @method  static Builder where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method  static Builder orWhere(string $column, string $operator = null, string $value = null)
 * @method  static Builder|Model findOrFail(mixed | int | string $id, array $column = ['*'])
 * @see     Builder
 */
trait ModelTrait
{
	use Sluggable;
	use SluggableScopeHelpers;
	use ModelMethodTrait;
	use ModelRelateTrait;

	public function getSlugKeyName() {
		return 'slug';
	}

	/**
	 * set auto upload image in method save
	 * @var bool
	 */
	public $auto_upload_image = true;

	/**
	 * this field save slug to database
	 * default is field slug
	 * @return string
	 */
	public function fieldSlug() {
		return "slug";
	}

	/**
	 * this method return field to use slug
	 * ex : [name | title ...]
	 * @return string|array
	 */
	public function fieldSlugable() {
		return '';
	}

	/**
	 * field show text when using method getLinkSlug and getLinkSlugAndId
	 * this is field convert to field slug
	 * ex : [name | title ...]
	 * @return array|string
	 */
	public function fieldTextLink() {
		return $this->fieldSlugable();
	}

	/**
	 * @return array
	 */
	public function sluggable(): array {
		$attribute = key_exists($this->fieldSlug(), $this->getAttributes());
		if (isset($attribute) && $attribute) {
			return [
				$this->fieldSlug() => [
					'source' => $this->fieldSlugable()
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
		if (!$this->beforeSave()) {
			return $this->beforeSave();
		}
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
		$this->afterSave();

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
			return view('admin.layouts.widget.labels.active', [
				'slot'          => $this->is_active,
				'text_active'   => $this->getTextActive(),
				'text_inactive' => $this->getTextInActive(),
				'text_other'    => $this->getOtherTextActive()
			]);
		}

		return "";
	}

	/**
	 * @return array|null|string
	 */
	public function getTextActive() {
		return __('admin/common.active');
	}

	/**
	 * @return array|null|string
	 */
	public function getTextInActive() {
		return __('admin/common.inactive');
	}

	/**
	 * method return others text active without value 0 , 1
	 * ex: case value is_active difference 0 & 1 then label active will get value from this method
	 * @return string
	 */
	public function getOtherTextActive() {
		return '';
	}

	/**
	 * @return boolean
	 */
	public function beforeSave() {
		return true;
	}

	/**
	 * @return boolean
	 */
	public function afterSave() {
		return true;
	}

	/**
	 * @return string
	 */
	public static function table() {
		return (new static)->getTable();
	}

	/**
	 * Delete the model from the database.
	 * @return bool|null
	 * @throws \Exception
	 */
	public function delete() {
		parent::delete();
	}

	/**
	 * @param int $value
	 * @return Builder
	 */
	public function whereIsActive($value = 1) {
		return self::where('is_active', $value);
	}

	/**
	 * @return int|string
	 */
	public function getSlugAndId() {
		if (!empty($this->{$this->getSlugKeyName()})) {
			return $this->{$this->getSlugKeyName()} . "--" . $this->id;
		}
		else {
			return $this->id;
		}
	}

	/**
	 * @param string             $prefix
	 * @param string|array|mixed $params
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public function getUrlSlugAndId($prefix = '', $params = []) {
		if (!empty($prefix)) {
			$prefix .= '/';
		}

		return url($prefix . $this->getSlugAndId(), $params);
	}

	/**
	 * @param string             $prefix
	 * @param string|array|mixed $params
	 * @return \Illuminate\Contracts\Routing\UrlGenerator|string
	 */
	public function getUrlSlug($prefix = '', $params = '') {
		if (!empty($prefix)) {
			$prefix .= '/';
		}

		return url($prefix . $this->{$this->fieldSlug()}, $params);
	}

	/**
	 * @param string $prefix
	 * @param string $field
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getLinkSlugAndId($prefix = '', $field = '') {
		return $this->getLink($this->getUrlSlugAndId($prefix), $field);
	}

	/**
	 * @param string $prefix
	 * @param string $field
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getLinkSlug($prefix = '', $field = '') {
		return $this->getLink($this->getUrlSlug($prefix), $field);
	}

	/**
	 * @param null   $url
	 * @param string $field
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getLink($url = null, $field = '') {
		if (empty($field)) {
			$field = $this->{$this->fieldTextLink()};
		}

		return view('admin.layouts.widget.links.link', ['url' => $url, 'text' => $field]);
	}
}
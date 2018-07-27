<?php

namespace App\Models;

use App\Models\Traits\ModelMethodTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App\Models
 * @property string $type
 * @property int    $is_active
 * @property int    parent_id
 * @property string name
 */
class Category extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	const TYPE_CATEGORY = 'category';
	const TYPE_AREA     = 'area';
	const TYPE_CITY     = 'city';
	const TYPE_DISTRICT = 'district';
	const TYPE_STREET   = 'street';
	protected $fillable = ['parent_id', 'image', 'name', 'slug', 'is_active', 'status', 'description', 'type', 'path'];

	/**
	 * @param string $column
	 * @param null   $key
	 * @return mixed
	 */
	public static function pluckWithCategory($column, $key = null) {
		return self::pluckWithType($column, $key, self::TYPE_CATEGORY);
	}

	public static function pluckWithArea($column, $key = null) {
		return self::pluckWithType($column, $key, self::TYPE_AREA);
	}

	public static function pluckWithType($column, $key = null, $type = '') {
		$category = Category::where('type', $type)->pluck($column, $key);
		/** @var Collection $category */
		$category->put(0, __('admin.select') . " " . __("admin.$type"));
		$category = $category->toArray();
		ksort($category);

		return new Collection($category);
	}

	/**
	 * @return string
	 */
	public function fieldSlugable() {
		return 'name';
	}

	/**
	 * @param string $type
	 * @return mixed
	 */
	public function getParent($type = self::TYPE_CATEGORY) {
		return $this->hasOne(Category::class, 'id', 'parent_id')->where('type', $type)->first();
		//Category::where('id', $this->parent_id)->where('type', $type)->first();
	}

	/**
	 * @param string $type
	 * @return string
	 */
	public function getParentName($type = self::TYPE_CATEGORY) {
		$category = $this->getParent($type);
		if (isset($category)) {
			if (isset($category->name)) {
				return $category->name;
			}
		}

		return "";
	}

	/**
	 * @param string $type
	 * @return int
	 */
	public function getParent_id($type = self::TYPE_CATEGORY) {
		$category = $this->getParent($type);
		if (isset($category)) {
			if (isset($category->id)) {
				return $category->id;
			}
		}

		return 0;
	}

	public function getParents($type = self::TYPE_CATEGORY) {
		return Category::where('id', $this->parent_id)->where('type', $type)->get();
	}


	public static function getCategoryByParent($parent_id = 0, $type = self::TYPE_CATEGORY) {
		$category = Category::where('type', $type)->where('parent_id', $parent_id)->pluck('name', 'id');
		/** @var Collection $category */
		$category->put(0, __('admin.select') . " " . __("admin.$type"));
		$category = $category->toArray();
		ksort($category);

		return new Collection($category);
	}

	/**
	 * @param string $type
	 * @return Builder
	 */
	public static function whereType($type = self::TYPE_CATEGORY) {
		return self::where('type', $type);
	}

	/**
	 * @param string $type
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getChildren() {
		return $this->hasMany(self::class, 'parent_id', 'id');
	}

}

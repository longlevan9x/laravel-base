<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App\Models
 * @property string $type
 * @property int $is_active
 */
class Category extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	const TYPE_CATEGORY = 'category';
	protected $fillable = ['parent_id', 'image', 'name', 'slug', 'is_active', 'status', 'description', 'type'];

	/**
	 * @param string $column
	 * @param null   $key
	 * @return mixed
	 */
	public static function pluckWithCategory($column, $key = null) {
		$category = Category::where('type', self::TYPE_CATEGORY)->pluck($column, $key);
		/** @var Collection $category */
		$category->put(0, 'Select Category');
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

	public function getParent() {
		return $this->hasOne(Category::class, 'id', 'parent_id');
	}

	/**
	 * @return string
	 */
	public function getParentName() {
		$category = $this->getParent();
		if (isset($category)) {
			if (isset($category->name)) {
				return $category->name;
			}
		}
		return "";
	}
}

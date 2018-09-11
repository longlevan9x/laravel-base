<?php

namespace App\Models;

use App\Models\Traits\ModelMethodTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Category
 * @package App\Models
 * @property string      $type
 * @property int         $is_active
 * @property int         parent_id
 * @property string      name
 * @property int         $id
 * @property string|null $image
 * @property string|null $slug
 * @property string|null $status
 * @property string|null $description
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Admins $authorUpdated
 * @method static Builder|Category findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereImage($value)
 * @method static Builder|Category whereIsActive($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category wherePath($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereStatus($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category whereSortOrder($value)
 * @method static Builder|Category sortOrder()
 * @method static Builder|Category active()
 * @mixin \Eloquent
 * @property int         sort_order
 * @property string      seo_title
 * @property string      seo_keyword
 * @property string      seo_description
 * \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereType($value)
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
	protected $fillable = [
		'parent_id',
		'image',
		'name',
		'slug',
		'is_active',
		'status',
		'description',
		'type',
		'path',
		'seo_title',
		'seo_keyword',
		'seo_description'
	];

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
		$category = Category::where('type', $type)->where('parent_id', '>', 0)->pluck($column, $key);
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
	 * @return Builder|Category
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

	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeSortOrder($query) {
		return $query->orderBy('sort_order');
	}
}

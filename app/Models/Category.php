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
 *
 * @package App\Models
 * @property string      $type
 * @property int         $is_active
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
 * @property int         $parent_id
 * @property string      $name
 * @property int|null    $sort_order
 * @property string|null $seo_title
 * @property string|null $seo_keyword
 * @property string|null $seo_description
 * @method static Builder|Category inActive()
 * @method static Builder|Category whereSeoDescription($value)
 * @method static Builder|Category whereSeoKeyword($value)
 * @method static Builder|Category whereSeoTitle($value)
 * @method static Builder|Category whereType($value = '')
 * @property-read Admins $author
 * @method static Builder|Category orderBySortOrder()
 * @method static Builder|Category orderBySortOrderDesc()
 * @property int|null    $block_id
 * @property int|null    $is_detail
 * @property int|null    $is_home
 * @method static Builder|Category whereBlockId($value)
 * @method static Builder|Category whereIsDetail($value)
 * @method static Builder|Category whereIsHome($value)
 * @method static Builder|Category myPluck($column, $key = null, $title = '')
 */
class Category extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	const TYPE_CATEGORY = 'category';
	protected $fillable = [
		'parent_id',
		'block_id',
		'image',
		'name',
		'slug',
		'is_active',
		'is_home',
		'is_detail',
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

	/**
	 * @param        $column
	 * @param null   $key
	 * @param string $type
	 * @return Collection
	 */
	public static function pluckWithType($column, $key = null, $type = '') {
		$category = self::whereType($type)->where('parent_id', '>', 0)->pluck($column, $key);
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
		return $this->hasOne(self::class, 'id', 'parent_id')->where('type', $type)->first();
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

	public static function getCategoryByParent($parent_id = 0, $type = self::TYPE_CATEGORY) {
		$category = self::whereType($type)->whereParentId($parent_id)->pluck('name', 'id');
		/** @var Collection $category */
		$category->put(0, __('admin.select') . " " . __("admin.$type"));
		$category = $category->toArray();
		ksort($category);

		return new Collection($category);
	}

	/**
	 * @return mixed|string
	 */
	public function getType() {
		if (empty($this->type)) {
			return $this->type = request()->query('type', self::TYPE_CATEGORY);
		}

		return $this->type;
	}

//	/**
//	 * @return Builder
//	 */
//	public function newQuery() {
//		return parent::newQuery()->whereType($this->getType()); // TODO: Change the autogenerated stub
//	}

	/**
	 * @param Builder $query
	 * @param string  $type
	 * @return Builder
	 */
	public function scopeWhereType($query, $type = self::TYPE_CATEGORY) {
		if (!isset($type)) {
			$type = self::TYPE_CATEGORY;
		}

		return $query->where('type', $type);
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

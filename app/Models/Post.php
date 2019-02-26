<?php

namespace App\Models;

use App\Models\Traits\ModelCategoryTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Carbon\Carbon;
use Dimsav\Translatable\Translatable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as CollectionBase;

/**
 * Class Post
 *
 * @package App\Models
 * @property string                                                                      $title
 * @property string                                                                      $type
 * @property string                                                                      $post_time
 * @property Admins                                                                      $author
 * @property Admins                                                                      $authorUpdated
 * @property int                                                                         $author_id
 * @property string                                                                      $created_at
 * @property PostMeta                                                                    $postMeta
 * @property int                                                                         $id
 * @property int                                                                         $category_id
 * @property string|null                                                                 $status
 * @property Carbon|null                                                                 $updated_at
 * @property int|null                                                                    $parent_id
 * @property string|null                                                                 $slug
 * @property string|null                                                                 $image
 * @property int                                                                         $is_active
 * @property string|null                                                                 $overview
 * @property string|null                                                                 $content
 * @property string|null                                                                 $path
 * @property int|null                                                                    $author_updated_id
 * @property-read Category                                                               $category
 * ===Method===
 * @property-read CollectionBase|PostMeta[]                                              $postMetas
 * @method static Builder|Post findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Post whereAuthorId($value)
 * @method static Builder|Post whereAuthorUpdatedId($value)
 * @method static Builder|Post whereCategoryId($value)
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereImage($value)
 * @method static Builder|Post whereIsActive($value)
 * @method static Builder|Post whereOverview($value)
 * @method static Builder|Post whereParentId($value)
 * @method static Builder|Post wherePath($value)
 * @method static Builder|Post wherePostTime($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereStatus($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null                                                                 $seo_title
 * @property string|null                                                                 $seo_keyword
 * @property string|null                                                                 $seo_description
 * @method static Builder|Post active($value = 1)
 * @method static Builder|Post inActive()
 * @method static Builder|Post whereSeoDescription($value)
 * @method static Builder|Post whereSeoKeyword($value)
 * @method static Builder|Post whereSeoTitle($value)
 * @method static Builder|Post whereType($value = '')
 * @method static Builder|Post orderBySortOrder()
 * @method static Builder|Post orderBySortOrderDesc()
 * @property-read CollectionBase|Comment[]                                               $comments
 * @property-read CollectionBase|Tag[]                                                   $tags
 * @property-read CollectionBase|Relationship[]                                          $relationships
 * @property int|null                                                                    $is_comment
 * @method static Builder|Post whereIsComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withTranslation()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[]         $commentsActive
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post postTime($time = '')
 */
class Post extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	//use Translatable;
	use ModelCategoryTrait;

	const TYPE_POST = 'post';
	const TYPE_NEWS = 'news';
	public static $TYPE_NEWS = self::TYPE_NEWS;
	public static $TYPE_POST = self::TYPE_POST;

	protected $fillable = [
		'author_id',
		'parent_id',
		'category_id',
		'title',
		'slug',
		'image',
		'is_active',
		'is_comment',
		'post_time',
		'type',
		'overview',
		'content',
		'status',
		'seo_title',
		'seo_keyword',
		'seo_description',
		'author_updated_id',
		'path'
	];

	public $translatedAttributes = [
		'title',
		'overview',
		'content',
		'seo_title',
		'seo_keyword',
		'seo_description',
	];

	/**
	 * @param string $type
	 */
	public function setType($type = self::TYPE_POST) {
		$this->type = $type;
	}

	/**
	 * @return mixed|string
	 */
	public function getType() {
		if (empty($this->type)) {
			return $this->type = request()->query('type', static::TYPE_POST);
		}

		return $this->type;
	}

	/**
	 * @return string
	 */
	public function fieldSlugable() {
		return 'title';
	}

	/**
	 * @param Builder $query
	 * @param         $type
	 * @return Builder
	 */
	public function scopeWhereType($query, $type = null) {
		if (!isset($type)) {
			$type = static::TYPE_POST;
		}

		return $query->where('type', $type);
	}

	/**
	 * @return string
	 */
	public function parsePostTime() {
		return $this->post_time = Carbon::parse($this->post_time)->format("Y-m-d H:i:s");
	}

	/**
	 * @return bool
	 */
	public function beforeSave() {
		$this->parsePostTime();
		if (in_array($this->getType(), [
			static::TYPE_NEWS,
		])) {
			$this->path = "post/" . $this->getType();

			return $this->folder = $this->path;
		}

		return true;
	}

	/**
	 * @return mixed|string
	 */
	public function folder() {
		if (in_array($this->getType(), [
			static::TYPE_NEWS,
		])) {
			$this->path = "post/" . $this->getType();

			return $this->folder = $this->path;
		}

		if (empty($this->folder)) {
			$this->path = $this->getTable();

			return $this->folder = $this->path;
		}

		return $this->folder;
	}

	/**
	 * @param        $column
	 * @param null   $key
	 * @param string $type
	 * @return Collection
	 */
	public static function pluckWithType($column, $key = null, $type = '') {
		$post = static::where('type', $type)->pluck($column, $key);
		/** @var Collection $post */
		$post->put(0, __('admin.select') . " " . __("admin.$type"));
		$post = $post->toArray();
		ksort($post);

		return new Collection($post);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function postMeta() {
		return $this->hasOne(PostMeta::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function postMetas() {
		return $this->hasMany(PostMeta::class);
	}

	/**
	 * @param string $type
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne|Post
	 */
	public function getParent($type = '') {
		$relate = $this->hasOne(Post::class, 'id', 'parent_id');
		if (!empty($type)) {
			$relate->where('type', $type);
		}

		return $relate;
		//Category::where('id', $this->parent_id)->where('type', $type)->first();
	}

	/**
	 * @return Builder
	 */
	public function queryWithPostMeta() {
		return static::query()->join(PostMeta::table(), PostMeta::table() . '.post_id', '=', Post::table() . '.id');
	}

	/**
	 * @param null $models
	 * @return Post|Builder|mixed
	 */
	public static function prepareMetaValueKey($models = null) {
		if (!isset($models) || empty($models)) {
			$models = (new static)->queryWithPostMeta()->get();
		}

		/** @var Model $model */
		$model = new static;
		if (isset($models) && !empty($models)) {
			$model = $models->get(0);
			foreach ($models as $index => $item) {
				/** @var PostMeta $item */
				$model->setAttribute($item->key, $item->value);
			}

			return $model;
		}

		return $model;
	}

	/**
	 * Post constructor.
	 * @param array $attributes
	 */
	public function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->setMaxImageHeight(500);
		$this->setMaxImageWidth(500);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|Comment
	 */
	public function comments() {
		return $this->hasMany(Comment::class, 'post_id');
	}

	/**
	 * @return Comment|Builder
	 */
	public function commentsActive() {
		return $this->hasMany(Comment::class, 'post_id')->active();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags() {
		$table = call_user_func(get_called_class() . "::table");
		return $this->belongsToMany(Tag::class, Relationship::table(), 'relation2_id', 'relation1_id')->where('relation_type', Tag::table() . $table);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|Relationship
	 */
	public function relationships() {
		return $this->hasMany(Relationship::class, 'relation2_id')->where('relation_type', Tag::table() . Post::table());
	}
}

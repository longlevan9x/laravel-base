<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Tag
 *
 * @property int                                                              $id
 * @property int                                                              $post_id
 * @property string                                                           $name
 * @property int|null                                                         $is_active
 * @property string|null                                                      $type
 * @property \Illuminate\Support\Carbon|null                                  $created_at
 * @property \Illuminate\Support\Carbon|null                                  $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Admins                                          $authorUpdated
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag active($value = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag inActive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereSlug($slug)
 * @property string|null                                                      $slug
 * @property string|null                                                      $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag whereDescription($value)
 * @property-read \App\Models\Admins                                          $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag orderBySortOrder()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag orderBySortOrderDesc()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag postTime($time = '')
 */
class Tag extends Model
{
	use ModelTrait;
	protected $fillable = ['name', 'is_active', 'type', 'slug', 'description'];

	/**
	 * @return string
	 */
	public function fieldSlugable() {
		return 'name';
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function posts() {
		return $this->belongsToMany(Post::class, Relationship::table(), 'relation1_id', 'relation2_id')->where('relation_type', Tag::table() . Post::table())->withTranslation();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Builder|ModelTrait
	 */
	public function products() {
		return $this->belongsToMany(Product::class, Relationship::table(), 'relation1_id', 'relation2_id')->where('relation_type', Tag::table() . Product::table())->withTranslation();
	}
}

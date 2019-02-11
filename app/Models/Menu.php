<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Menu
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $url
 * @property string      $type
 * @property int|null    $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Admins $author
 * @property-read Admins $authorUpdated
 * @method static Builder|Menu active($value = 1)
 * @method static Builder|Menu findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Menu inActive()
 * @method static Builder|Menu orderBySortOrder()
 * @method static Builder|Menu orderBySortOrderDesc()
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereIsActive($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereSlug($slug)
 * @method static Builder|Menu whereType($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @method static Builder|Menu whereUrl($value)
 * @mixin \Eloquent
 * @property int         $sort_order
 * @method static Builder|Menu whereSortOrder($value)
 * @method static Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuTranslation[] $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu orderByTranslation($key, $sortmethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu withTranslation()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu postTime($time = '')
 */
class Menu extends Model
{
	use ModelTrait;
	use Translatable;
	protected $fillable             = ['name', 'url', 'sort_order', 'type', 'is_active'];
	public    $translatedAttributes = ['name'];
}

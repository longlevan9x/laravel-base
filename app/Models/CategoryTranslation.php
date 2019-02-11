<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string|null $description
 * @property string|null $seo_title
 * @property string|null $seo_keyword
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereSeoKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryTranslation whereUpdatedAt($value)
 */
class CategoryTranslation extends Model
{
	protected $fillable = [
		'category_id',
		'name',
		'description',
		'seo_title',
		'seo_keyword',
		'seo_description'
	];
}

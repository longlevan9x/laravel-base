<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $menu_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuTranslation whereUpdatedAt($value)
 */
class MenuTranslation extends Model
{
	protected $fillable = ['name', 'menu_id'];
}

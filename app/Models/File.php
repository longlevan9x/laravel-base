<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 *
 * @property int $id
 * @property string $original_name
 * @property string $base_name
 * @property string|null $original_extension
 * @property float|null $size
 * @property string|null $mine_type
 * @property string|null $entity
 * @property int|null $entity_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Admins $author
 * @property-read \App\Models\Admins $authorUpdated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File active($value = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File inActive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File orderBySortOrder()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File orderBySortOrderDesc()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File postTime($time = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereBaseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMineType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSlug($slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	protected $fillable = ['original_name', 'base_name', 'original_extension', 'size', 'mime_type', 'entity', 'entity_id', 'description'];
}

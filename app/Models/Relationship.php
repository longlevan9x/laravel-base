<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Relationship
 *
 * @mixin \Eloquent
 * @property-read Admins $author
 * @property-read Admins $authorUpdated
 * @method static Builder|Relationship active($value = 1)
 * @method static Builder|Relationship findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Relationship inActive()
 * @method static Builder|Relationship orderBySortOrder()
 * @method static Builder|Relationship orderBySortOrderDesc()
 * @method static Builder|Relationship whereSlug($slug)
 * @property int         $id
 * @property string|null $relation_type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Relationship whereCreatedAt($value)
 * @method static Builder|Relationship whereId($value)
 * @method static Builder|Relationship whereRelationType($value)
 * @method static Builder|Relationship whereUpdatedAt($value)
 * @method static bool saveMultiple(int | array | string $relation1_id, int | array | string $relation2_id, string $relation_type)
 * @property int|null    $relation1_id
 * @property int|null    $relation2_id
 * @method static Builder|Relationship whereRelation1Id($value)
 * @method static Builder|Relationship whereRelation2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Relationship postTime($time = '')
 */
class Relationship extends Model
{
	use ModelTrait;
	protected $fillable = ['relation1_id', 'relation2_id', 'relation_type'];

	/**
	 * @param  Builder         $query
	 * @param int|array|string $relation1_id
	 * @param int|array|string $relation2_id
	 * @param string           $relation_type
	 * @return bool
	 * @throws \Exception
	 */
	public function scopeSaveMultiple($query, $relation1_id, $relation2_id, $relation_type) {
		if (is_array($relation1_id)) {
			$query->whereNotIn('relation1_id', $relation1_id)->where('relation_type', $relation_type)->delete();
			foreach ($relation1_id as $id) {
				self::firstOrCreate(['relation1_id' => $id, 'relation_type' => $relation_type, 'relation2_id' => $relation2_id]);
			}

			return true;
		}
		elseif (is_array($relation2_id)) {
			$query->whereNotIn('relation2_id', $relation2_id)->where('relation_type', $relation_type)->delete();
			foreach ($relation1_id as $id) {
				self::firstOrCreate(['relation2_id' => $id, 'relation_type' => $relation_type, 'relation1_id' => $relation1_id]);
			}

			return true;
		}
	}
}

<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/25/2018
 * Time: 00:24
 */

namespace App\Models\Traits;


use App\Commons\Facade\Common;
use App\Commons\Facade\CUser;
use App\Models\Admins;
use App\Models\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

/**
 * Trait ModelRelateTrait
 * @package App\Models\Traits
 */
trait ModelRelateTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Admins
	 */
	public function authorUpdated() {
		return $this->belongsTo(Admins::class, 'author_updated_id', 'id');
	}

	/**
	 * @return string
	 */
	public function getAuthorUpdatedName() {
		return $this->getRelateValue($this->authorUpdated, 'username', '-');
	}

	/**
	 * @return int
	 */
	public function setAuthorUpdatedId() {
		return $this->author_updated_id = CUser::userAdmin()->id;
	}

	/**
	 * @return int
	 */
	public function setAuthorId() {
		return $this->author_id = CUser::userAdmin()->id;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Admins
	 */
	public function author() {
		return $this->belongsTo(Admins::class, 'author_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany|Relationship
	 */
	public function relationships() {
		return $this->hasMany(Relationship::class, 'relation2_id')->where('relation_type', $this->relationType());
	}

	/**
	 * @return string
	 */
	public function relationType() {
		return '';
	}

	/**
	 * @return string
	 */
	public function getAuthorName() {
		return $this->getRelateValue($this->author, 'username', '-');
	}

	/**
	 * @param HasOne|BelongsTo|Model $relation
	 * @param string           $key
	 * @param string           $default
	 * @return mixed|string
	 */
	public function getRelateValue($relation, $key, $default = '') {
		return Common::getRelateValue($relation, $key, $default);
	}
}
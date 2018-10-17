<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/25/2018
 * Time: 00:24
 */

namespace App\Models\Traits;


use App\Commons\Facade\CUser;
use App\Models\Admins;

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
		if (isset($this->authorUpdated)) {
			if ($this->authorUpdated->username == CUser::userAdmin()->username) {
				return __("admin/common.you");
			}

			return $this->authorUpdated->username;
		}

		return '-';
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
	 * @return string
	 */
	public function getAuthorName() {
		if (isset($this->author)) {
			if ($this->author->username == CUser::userAdmin()->username) {
				return __("admin/common.you");
			}

			return $this->author->username;
		}

		return '-';
	}
}
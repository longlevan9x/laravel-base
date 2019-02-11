<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 11:20 AM
 */

namespace App\Commons;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Common
{
	/**
	 * @param string $app_name
	 * @return mixed
	 */
	public function showAppName($app_name = '') {
		return str_replace('_', ' ', $app_name);
	}

	/**
	 * @param BelongsTo|HasOne|Model $relation
	 * @param string                 $key
	 * @param string                 $default
	 * @return string
	 */
	public function getRelateValue($relation, $key, $default = '') {
		if ($relation instanceof BelongsTo || $relation instanceof HasOne) {
			$relation = $relation->select($key)->first();
		}

		return $relation->{$key} ?? $default;
	}
}
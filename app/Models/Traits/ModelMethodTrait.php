<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/11/2018
 * Time: 00:48
 */

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;

/**
 * Trait ModelMethodTrait
 * @package App\Models\Traits
 * @method  static Builder where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method  static Builder orWhere(string $column, string $operator = null, string $value = null)
 * @method  static QueryBuilder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method  static Builder|Model findOrFail(mixed | int | string $id, array $column = ['*'])
 * @method  static Builder|Model updateOrCreate(array $attributes, array $values = [])
 * @method  static Builder whereId(int | string $id)
 * @method  static Builder whereIsActive(int $value)
 * @method  static Builder|static active($value = 1)
 * @method  static Builder|static inActive()
 * @method  static Builder|static orderBySortOrder()
 * @see     Builder
 * @see     QueryBuilder
 */
trait ModelMethodTrait
{
	/**
	 * @param  QueryBuilder $query
	 * @param int           $value
	 * @return QueryBuilder|static
	 */
	public function scopeActive($query, $value = 1) {
		return $query->where('is_active', $value);
	}

	/**
	 * @param QueryBuilder $query
	 * @return QueryBuilder|static
	 */
	public function scopeInActive($query) {
		return $this->scopeActive($query, 0);
	}

	/**
	 * @param QueryBuilder $query
	 * @return QueryBuilder|static
	 */
	public function scopeOrderBySortOrder($query) {
		return $query->orderBy('sort_order');
	}

	/**
	 * @param QueryBuilder $query
	 * @return QueryBuilder|static
	 */
	public function scopeOrderBySortOrderDesc($query) {
		return $query->orderByDesc('sort_order');
	}

	/**
	 * @param Builder $query
	 * @param string  $time
	 * @return mixed
	 */
	public function scopePostTime(Builder $query, $time = '') {
		if ($time == '') {
			$time = Carbon::now();
		}

		return $query->where('post_time', "<", $time);
	}

	public function scopeMyPluck($query, $column, $key = null, $title = '') {
		$models = $query->get()->pluck($column, $key);
		/** @var Collection $models */
		$models->put(0, __('admin.select') . " " . $title);
		$models = $models->toArray();
		ksort($models, SORT_STRING);

		//dd($models);
		return new Collection($models);
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 10/02/2018
 * Time: 19:16
 */

namespace App\Models\Traits;


use Illuminate\Support\Collection;

/**
 * Trait ModelStaticTrait
 * @package App\Models\Traits
 */
trait ModelStaticTrait
{
	/**
	 * @param        $column
	 * @param null   $key
	 * @param string $title
	 * @return Collection
	 */
	public static function pluck($column, $key = null, $title = '') {
		$models = self::query()->pluck($column, $key);
		/** @var Collection $models */
		$models->put(0, __('admin.select') . " " . $title);
		$models = $models->toArray();
		ksort($models, SORT_STRING);
		//dd($models);
		return new Collection($models);
	}
}
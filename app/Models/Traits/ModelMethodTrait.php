<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/11/2018
 * Time: 00:48
 */

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Trait ModelMethodTrait
 * @package App\Models\Traits
 * @method  static Builder where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method  static Builder orWhere(string $column, string $operator = null, string $value = null)
 * @method  static QueryBuilder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method  static Builder|Model findOrFail(mixed|int|string  $id, array $column = ['*'])
 * @method  static Builder|Model updateOrCreate(array $attributes, array $values = [])
 * @method  static Builder whereId(int|string $id)
 * @method  static Builder whereType(string $id)
 * @see Builder
 * @see QueryBuilder
 *
 */
trait ModelMethodTrait
{

}
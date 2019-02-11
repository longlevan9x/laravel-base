<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/10/2018
 * Time: 00:45
 */

namespace App\Commons\Facade;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Facade;

/**
 * Class Common
 * @package App\Commons\Facade
 * @method static string showAppName(string $app_name)
 * @method static string getRelateValue(HasOne|BelongsTo|Model $relation, $key, $default = '')
 * @see \App\Commons\Common
 */
class Common extends Facade
{
	protected static function getFacadeAccessor() {
		return \App\Commons\Common::class;
	}
}
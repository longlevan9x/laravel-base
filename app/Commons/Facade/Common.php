<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/10/2018
 * Time: 00:45
 */

namespace App\Commons\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Common
 * @package App\Commons\Facade
 * @method static string showAppName(string $app_name)
 * @see \App\Commons\Common
 */
class Common extends Facade
{
	protected static function getFacadeAccessor() {
		return \App\Commons\Common::class;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/26/2018
 * Time: 16:09
 */

namespace App\Models\Facade;


use App\Models\Setting;
use Illuminate\Support\Facades\Facade;

/**
 * Class SettingFacade
 * @package App\Models\Facade
 * @method static Setting prepareKeyValues(array $keyValues, array $options = [])
 * @method static Setting fillKeyValues(array $keys, array $data = [])
 * @method static Setting loadModelByKey()
 * @method static Setting getValue(string $key = '')
 * @method static Setting setKeyFillable(...$key)
 * @see Setting
 */
class SettingFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'setting';
	}
}
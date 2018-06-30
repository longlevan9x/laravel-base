<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 5:08 PM
 */

namespace App\Commons\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class CFile
 * @package App\Commons\Facade
 * @method static string upload(string $key, string $folder, string $old_image)
 * @method static string remove(string $folder, string $old_image)
 * @method static string getImageUrl(string $folder, string $image, string $default_image)
 * @see \App\Commons\CFile
 */
class CFile extends Facade
{
	protected static function getFacadeAccessor() {
		return 'c-file';
	}
}
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
 * @method static string|boolean upload(string $key, string $folder, string $old_image = '')
 * @method static boolean removeFile(string $folder, string $file)
 * @method static string getImageUrl(string $folder, string $image, string $default_image = '')
 * @method static string getErrors()
 * @property string $errors
 * @see     \App\Commons\CFile
 */
class CFile extends Facade
{
	protected static function getFacadeAccessor() {
		return 'c-file';
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/24/2018
 * Time: 3:11 PM
 */

namespace App\Models\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Semester
 * @package App\Models\Facade
 * @method static string syncSemester()
 * @see \App\Models\Semester
 */
class Semester extends Facade
{
	/**
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'semester';
	}
}
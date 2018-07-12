<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 11:20 AM
 */

namespace App\Commons;


class Common
{
	/**
	 * @param string $app_name
	 * @return mixed
	 */
	public function showAppName($app_name = '') {
		return str_replace('_', ' ', $app_name);
	}
}
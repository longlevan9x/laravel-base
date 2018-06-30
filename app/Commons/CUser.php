<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 11:20 AM
 */

namespace App\Commons;


use App\Models\Admins;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CUser extends Common
{
	/**
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null|User
	 */
	public function user() {
		return Auth::user();
	}

	/**
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null|Admins
	 */
	public function userAdmin() {
		return $this->user();
	}

	/**
	 * @param $class
	 * @return null|string
	 */
	public function getTableName($class) {
		if (class_exists($class)) {
			/** @var Model $class */
			$class = new $class();
			return $class->getTable();
		}
		return null;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 11:20 AM
 */

namespace App\Commons;


use App\Commons\Facade\CUser as CUserFacade;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Class CUser
 * @package App\Commons
 */
class CUser extends Common
{
	/**
	 * CUser constructor.
	 */
	public function __construct() { }

	protected $user;

	/**
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null|User
	 */
	public function user() {
		return $this->user = isset($this->user) ? $this->user : Auth::user();
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
			$class = new $class;

			return $class->getTable();
		}

		return null;
	}

	/**
	 * @return int
	 */
	public function getCurrentRoleAdmin() {
		return $this->userAdmin()->role;
	}

	/**
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}
}
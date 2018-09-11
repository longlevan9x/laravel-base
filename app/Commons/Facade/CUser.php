<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/28/2018
 * Time: 11:22 AM
 */

namespace App\Commons\Facade;


use App\Models\Admins;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Facade;

/**
 * Class CUser
 * @package App\Commons\Facade
 * @method static Authenticatable|null|Admins userAdmin()
 * @method static Authenticatable|null|Admins user()
 * @method static Authenticatable|null|Admins getTableName(string $class)
 * @method static boolean checkRole(int|array|string $role = "", int|array|string $role = "")
 * @method static boolean|null getCurrentRoleAdmin()
 * @method static Admins|null setUser($user)
 * @method static Admins|null getUser()
 * @see     \App\Commons\CUser
 */
class CUser extends Facade
{
	protected static function getFacadeAccessor() {
		return 'c-user';
	}
}
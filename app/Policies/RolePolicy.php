<?php

namespace App\Policies;

use App\Models\Admins;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Silber\Bouncer\Database\Role;

class RolePolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param Role   $ability
	 * @return bool
	 */
	public function index(Admins $user, Role $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Role   $ability
	 * @return bool
	 */
	public function create(Admins $user, Role $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Role   $ability
	 * @return bool
	 */
	public function edit(Admins $user, Role $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Role   $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Role $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

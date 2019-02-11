<?php

namespace App\Policies;

use App\Models\Admins;
use App\User;

class UserPolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param User   $ability
	 * @return bool
	 */
	public function index(Admins $user, User $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param User   $ability
	 * @return bool
	 */
	public function create(Admins $user, User $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param User   $ability
	 * @return bool
	 */
	public function edit(Admins $user, User $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param User   $ability
	 * @return bool
	 */
	public function destroy(Admins $user, User $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

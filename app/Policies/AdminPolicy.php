<?php

namespace App\Policies;

use App\Models\Admins;

/**
 * Class AdminPolicy
 * @package App\Policies
 */
class AdminPolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param Admins   $ability
	 * @return bool
	 */
	public function index(Admins $user, Admins $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Admins   $ability
	 * @return bool
	 */
	public function create(Admins $user, Admins $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Admins   $ability
	 * @return bool
	 */
	public function edit(Admins $user, Admins $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Admins   $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Admins $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

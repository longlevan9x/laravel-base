<?php

namespace App\Policies;

use App\Models\Admins;
use App\Models\Menu;

class MenuPolicy extends AbstractPolicy
{
	/**
	 * @param Admins  $user
	 * @param Menu $ability
	 * @return bool
	 */
	public function index(Admins $user, Menu $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins  $user
	 * @param Menu $ability
	 * @return bool
	 */
	public function create(Admins $user, Menu $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins  $user
	 * @param Menu $ability
	 * @return bool
	 */
	public function edit(Admins $user, Menu $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins  $user
	 * @param Menu $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Menu $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

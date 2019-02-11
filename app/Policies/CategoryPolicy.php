<?php

namespace App\Policies;

use App\Models\Admins;
use App\Models\Category;

class CategoryPolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param Category   $ability
	 * @return bool
	 */
	public function index(Admins $user, Category $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Category   $ability
	 * @return bool
	 */
	public function create(Admins $user, Category $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Category   $ability
	 * @return bool
	 */
	public function edit(Admins $user, Category $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Category   $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Category $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

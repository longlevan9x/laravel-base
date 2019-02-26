<?php

namespace App\Policies;

use App\Models\Admins;
use App\Models\Tag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param Tag    $ability
	 * @return bool
	 */
	public function index(Admins $user, Tag $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Tag    $ability
	 * @return bool
	 */
	public function create(Admins $user, Tag $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Tag    $ability
	 * @return bool
	 */
	public function edit(Admins $user, Tag $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Tag    $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Tag $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

<?php

namespace App\Policies;

use App\Models\Admins;
use App\Models\Post;

/**
 * Class PostPolicy
 * @package App\Policies
 */
class PostPolicy extends AbstractPolicy
{
	/**
	 * @param Admins $user
	 * @param Post   $ability
	 * @return bool
	 */
	public function index(Admins $user, Post $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Post   $ability
	 * @return bool
	 */
	public function create(Admins $user, Post $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Post   $ability
	 * @return bool
	 */
	public function edit(Admins $user, Post $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}

	/**
	 * @param Admins $user
	 * @param Post   $ability
	 * @return bool
	 */
	public function destroy(Admins $user, Post $ability) {
		if (!$this->checkAbility($user, __FUNCTION__, $ability)) {
			return false;
		}

		return true;
	}
}

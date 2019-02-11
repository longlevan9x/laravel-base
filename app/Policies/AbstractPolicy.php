<?php

namespace App\Policies;

use App\Models\Admins;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractPolicy
{
	use HandlesAuthorization;

	/**
	 * @param Admins  $user
	 * @param         $ability
	 * @return bool
	 */
	public function before($user, $ability) {
		if ($user->isAn('admin')) {
			return true;
		}
	}

	/**
	 * @param Admins $user
	 * @param        $method
	 * @param Model  $ability
	 * @return bool
	 */
	public function checkAbility(Admins $user, $method, Model $ability) {
		$stringAbility = strtolower(class_basename($ability));

		return $user->can($stringAbility . '-' . $method);
	}

	/**
	 * @param Admins $user
	 * @param        $method
	 * @param Model  $ability
	 * @return bool
	 */
	public function checkAbilityString(Admins $user, $method, $ability) {
		return $user->can($ability . '-' . $method);
	}
}

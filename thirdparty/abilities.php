<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 12/28/2018
 * Time: 22:47
 */
// file include function using for abilities

if (!function_exists('ability_index')) {
	/**
	 * @param string $ability
	 * @return string
	 */
	function ability_index($ability) {
		return $ability . "-index";
	}
}

if (!function_exists('ability_show')) {
	/**
	 * @param string $ability
	 * @return string
	 */
	function ability_show($ability) {
		return $ability . "-show";
	}
}

if (!function_exists('ability_edit')) {
	/**
	 * @param string $ability
	 * @return string
	 */
	function ability_edit($ability) {
		return $ability . "-edit";
	}
}

if (!function_exists('ability_create')) {
	/**
	 * @param string $ability
	 * @return string
	 */
	function ability_create($ability) {
		return $ability . "-create";
	}
}

if (!function_exists('ability_destroy')) {
	/**
	 * @param string $ability
	 * @return string
	 */
	function ability_destroy($ability) {
		return $ability . "-destroy";
	}
}


if (!function_exists('can_index')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function can_index($ability, $arguments = []) {
		return Bouncer::can(ability_index($ability), $arguments);
	}
}

if (!function_exists('can_show')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function can_show($ability, $arguments = []) {
		return Bouncer::can(ability_show($ability), $arguments);
	}
}

if (!function_exists('can_edit')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function can_edit($ability, $arguments = []) {
		return Bouncer::can(ability_edit($ability), $arguments);
	}
}

if (!function_exists('can_create')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function can_create($ability, $arguments = []) {
		return Bouncer::can(ability_create($ability), $arguments);
	}
}

if (!function_exists('can_destroy')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function can_destroy($ability, $arguments = []) {
		return Bouncer::can(ability_destroy($ability), $arguments);
	}
}

if (!function_exists('cannot_index')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function cannot_index($ability, $arguments = []) {
		return Bouncer::cannot(ability_index($ability), $arguments);
	}
}

if (!function_exists('cannot_show')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function cannot_show($ability, $arguments = []) {
		return Bouncer::cannot(ability_show($ability), $arguments);
	}
}

if (!function_exists('cannot_edit')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function cannot_edit($ability, $arguments = []) {
		return Bouncer::cannot(ability_edit($ability), $arguments);
	}
}

if (!function_exists('cannot_create')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function cannot_create($ability, $arguments = []) {
		return Bouncer::cannot(ability_create($ability), $arguments);
	}
}

if (!function_exists('cannot_destroy')) {
	/**
	 * @param string $ability
	 * @param array  $arguments
	 * @return bool
	 */
	function cannot_destroy($ability, $arguments = []) {
		return Bouncer::cannot(ability_destroy($ability), $arguments);
	}
}


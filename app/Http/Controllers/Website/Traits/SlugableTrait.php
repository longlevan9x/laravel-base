<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 01/07/2019
 * Time: 09:44
 */

namespace App\Http\Controllers\Website\Traits;

/**
 * Trait SlugableTrait
 * @package App\Http\Controllers\Website\Traits
 */
trait SlugableTrait
{
	/**
	 * @param $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showBySlug($slug) {
		if (strpos($slug, '--') == false) {
			return $this->showByCategory($slug);
		}

		return $this->showDetail($slug);
	}

	/**
	 * @param string $slug
	 * @return string|null
	 */
	public function getSlugDetail(&$slug) {
		$id   = substr($slug, strpos($slug, '--'));
		$slug = str_replace($id, '', $slug);

		return $slug;
	}

	/**
	 * @param string $type
	 * @return mixed|string
	 */
	public function getTypeSlug($type) {
		return config('common.menu.url')[$type] ?? '';
	}
}
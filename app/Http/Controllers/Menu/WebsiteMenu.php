<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 10/07/2018
 * Time: 14:11
 */

namespace App\Http\Controllers\Menu;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

/**
 * Class WebsiteMenu
 * @package App\Http\Controllers\Menu
 */
class WebsiteMenu
{
	/**
	 * render menus in file Middleware\RedirectIfNotAdmin
	 * @return void
	 */
	public static function render() {
		View::share('menus', (new self)->menu());
	}

	/**
	 * @return array
	 */
	public static function getMenu() {
		return (new  self)->menu();
	}

	public function menu() {
		$menus0   = [
			['text' => __('website.home page'), 'url' => url('/')],
		];
		$menuData = Menu::active()->withTranslation()->orderBySortOrder()->get();

		$menus1 = $this->prepareMenu($menuData);

		return $menus = array_merge($menus0, $menus1);
	}

	/**
	 * @param       $categories
	 * @param int   $parent_id
	 * @param array $output
	 * @param int   $level
	 * @return array
	 */
	public function getCategoryMenu($categories, $parent_id = 0, &$output = [], $level = 0) {
		foreach ($categories as $category) {
			/** @var Category $category */
			if ($category->parent_id == $parent_id) {
				if ($category->parent_id == 0) {
					$url = $category->slug;
					if ($category->type == config('common.menu.type.san-pham')) {
						$url = config('common.menu.url.product') . "/" . $category->slug;
					}

					if ($category->type == config('common.menu.type.tuyen-dung')) {
						$url = config('common.menu.url.recruitment') . "/" . $category->slug;
					}

					if ($category->type == config('common.menu.type.gioi-thieu')) {
						$url = config('common.menu.url.introduce') . "/" . $category->slug;
					}

					if ($category->type == config('common.menu.type.dich-vu')) {
						$url = config('common.menu.url.service') . "/" . $category->slug;
					}

					$output[$category->id] = [
						'text'     => $category->name,
						'url'      => url($url),
						'image'    => $category->getImageUrl(),
						'children' => []
					];
				}
				else {
					$output[$category->parent_id]['url'] = "#";

					$output[$category->parent_id]['children'][$category->id] = [
						'text'  => $category->name,
						'url'   => url($category->slug),
						'image' => $category->getImageUrl(),
					];
					unset($category->id);
				}
				$id = $category->id;
				unset($category->id);
				$this->getCategoryMenu($categories, $id, $output, $level);
			}
		}

		return $output;
	}

	/**
	 * @param $menus
	 * @return array
	 */
	private function prepareMenu($menus) {
		$data = [];
		/** @var Menu $menu */
		foreach ($menus as $index => $menu) {
			$data[$index]             = [
				'text'     => $menu->name,
				'url'      => url($menu->url),
				'children' => []
			];
			$categories               = Category::whereType($menu->type)->withTranslation()->active()->get();
			$categories               = $this->getCategoryMenu($categories);
			$data[$index]['children'] = $categories;
		}

		return $data;
	}

}
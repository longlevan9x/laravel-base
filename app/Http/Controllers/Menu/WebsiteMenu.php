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
		//		if (cache()->has('menus')) {
		//			$menus = Cache::get('menus');
		//		} else {

		//		$menus0 = [
		//			['text' => __('website.home page'), 'url' => url('/')],
		//			['text' => __('website.product'), 'url' => url('/san-pham')],
		//		];
		//
		//		$menu   = Menu::query()->orderBy('sort_order')->get();
		//		$menus1 = [
		//			['text' => __('website.diseases'), 'url' => '#', 'children' => []],
		//		];
		//
		//		$categories            = Category::whereType(Category::TYPE_CATEGORY)->where('parent_id', '<>', 0)->where('is_active', 1)->get();
		//		$menus1[0]['children'] = $this->getCategoryMenu($categories);
		//
		//		$menus2 = [
		//			['text' => __('website.chuyen-gia'), 'url' => url('/chuyen-gia')],
		//			['text' => __('website.chia-se'), 'url' => url('/chia-se')],
		//			['text' => __('website.question answer'), 'url' => url('/hoi-dap')],
		//			['text' => __('website.news'), 'url' => url('/tin-tuc')],
		//			['text' => __('website.system_store'), 'url' => url('/he-thong-nha-thuoc')],
		//			['text' => __('website.order'), 'url' => url('/dat-hang')],
		//		];
		//
		//		$menus = array_merge($menus0, $menus1, $menus2);
		//		cache()->put('menus', $menus, 60);
		//		//		}

		//
		$menus0 = [
			['text' => __('website.home page'), 'url' => url('/')],
		];
		$menus2 = [
			['text' => __('admin/menu.contact'), 'url' => url('/lien-he')],
		];

		$menuData = Menu::active()->orderBySortOrder()->get();

		//$categories = Category::whereType()->active()->get();
		$menus1 = $this->prepareMenu($menuData);

		return $menus = array_merge($menus0, $menus1, $menus2);

		//view()->share(compact('menus'));
	}

	/**
	 * @param       $categories
	 * @param int   $parent_id
	 * @param array $output
	 * @param int   $level
	 * @return array
	 */
	public function getCategoryMenu($categories, $parent_id = 0, &$output = [], $level = 0) {
		//		foreach ($categories as $category) {
		//			$output[$category->id] = [
		//				'text' => $category->name,
		//				'url'  => url($category->slug),
		//			];
		//		}
		//
		//		return $output;
		foreach ($categories as $category) {
			/** @var Category $category */
			if ($category->parent_id == $parent_id) {
				if ($category->parent_id == 0) {
					$output[$category->id] = [
						'text'     => $category->name,
						'url'      => url($category->slug),
						'children' => []
					];
				}
				else {
					$output[$category->parent_id]['url'] = "#";

					$output[$category->parent_id]['children'][$category->id] = [
						'text' => $category->name,
						'url'  => url($category->slug)
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
			$categories               = Category::whereType($menu->type)->active()->get();
			$categories               = $this->getCategoryMenu($categories);
			$data[$index]['children'] = $categories;
		}

		return $data;
	}

}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 6/29/2018
 * Time: 4:23 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
	public static function render() {
		View::share('menus', (new MenuController)->menu());
	}

	/**
	 * @return array
	 */
	public function menu() {
		return [
			/*Dashboard*/
			[
				'name'     => __("admin/menu.dashboard"),
				'url'      => url_admin('/'),
				'visible'  => true,
				'icon'     => 'fa-home',
				'children' => []
			],
			/*Dashboard*/
			/*Profile*/
			[
				'name'     => __("admin/menu.your_profile"),
				'url'      => url_admin('profile'),
				'visible'  => true,
				'icon'     => 'fa-user-circle-o',
				'children' => []
			],
			/*Profile*/
			/*Product*/
			[
				'name'     => __("admin/menu.Product"),
				'url'      => url_admin('product/detail'),
				'visible'  => true,
				'icon'     => 'fa-user-circle-o',
				'children' => []
			],
			/*Product*/
			/*Category*/
			[
				'name'     => __("admin/menu.category"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'fa-list-alt',
				'children' => [
					[
						'name'    => __("admin/menu.list"),
						'url'     => url_admin('category'),
						'visible' => true,
						'icon'    => 'fa-list-alt',
					],
					[
						'name'    => __("admin/menu.add_new"),
						'url'     => url_admin('category/create'),
						'visible' => true,
						'icon'    => 'fa-plus',
					],
				]
			],
			/*Category*/
			/*User*/
			[
				'name'     => __("admin/menu.users"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'fa-user-circle',
				'children' => [
					[
						'name'    => __("admin/menu.list user"),
						'url'     => url_admin('admin'),
						'visible' => true,
						'icon'    => 'fa-user-circle',
					],
					[
						'name'    => __("admin/menu.add user"),
						'url'     => url_admin('admin/create'),
						'visible' => true,
						'icon'    => 'fa-plus',
					],
				]
			],
			/*User*/
			/*Setting*/
			[
				'name'     => __("admin/menu.setting"),
				'url'      => url_admin('setting'),
				'visible'  => true,
				'icon'     => 'fa-cog',
				'children' => []
			],
			/*Setting*/
		];
	}
}
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
			[
				'name'     => __("Home"),
				'url'      => url_admin('/'),
				'visible'  => true,
				'icon'     => 'fa-home',
				'children' => []
			],
			[
				'name'     => __("Profile"),
				'url'      => url_admin('profile'),
				'visible'  => true,
				'icon'     => 'fa-user-circle-o',
				'children' => []
			],
			[
				'name'     => __("Category"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'fa-list-alt',
				'children' => [
					[
						'name'     => __("List Category"),
						'url'      => url_admin('category'),
						'visible'  => true,
						'icon'     => 'fa-list-alt',
					],
					[
						'name'     => __("Add Category"),
						'url'      => url_admin('category/create'),
						'visible'  => true,
						'icon'     => 'fa-plus',
					],
				]
			],
			[
				'name'     => __("Area"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'fa-globe',
				'children' => [
					[
						'name'     => __("List Area"),
						'url'      => url_admin('area'),
						'visible'  => true,
						'icon'     => 'fa-globe',
					],
					[
						'name'     => __("Add Area"),
						'url'      => url_admin('area/create'),
						'visible'  => true,
						'icon'     => 'fa-plus',
					],
				]
			],
		];
	}
}
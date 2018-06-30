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
		];
	}
}
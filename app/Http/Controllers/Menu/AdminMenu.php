<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/29/2018
 * Time: 23:09
 */

namespace App\Http\Controllers\Menu;


use App\Commons\Facade\CUser;
use App\Models\Admins;
use Illuminate\Support\Facades\View;

class AdminMenu
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

	/**
	 * @return array
	 */
	public function menu() {
		$controller = request()->segment(2);
		$action     = request()->segment(3);

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
			/*Tags*/
			[
				'name'     => __('admin/menu.tag'),
				'url'      => '#',
				'visible'  => true,
				'active'   => $controller == 'tag' && $action > 0,
				'icon'     => 'fa-list-alt',
				'children' => [
					[
						'name'    => __('admin/menu.list'),
						'url'     => url_admin('tag'),
						'visible' => true,
						'icon'    => 'fa-bullhorn',
					],
					[
						'name'    => __('admin/menu.add'),
						'url'     => url_admin('tag/create'),
						'visible' => true,
						'icon'    => 'fa-plus',
					]
				]
			],
			/*Tags*/
			/*Category*/
			[
				'name'     => __('admin/menu.category'),
				'url'      => '#',
				'visible'  => true,
				'active'   => $controller == 'category' && $action > 0,
				'icon'     => 'fa-list-alt',
				'children' => [
					[
						'name'    => __('admin/menu.list'),
						'url'     => url_admin('category'),
						'visible' => true,
						'icon'    => 'fa-bullhorn',
					],
					[
						'name'    => __('admin/menu.add'),
						'url'     => url_admin('category/create'),
						'visible' => true,
						'icon'    => 'fa-plus',
					]
				]
			],
			/*Category*/
			/*Page*/
			[
				'name'     => __("admin/menu.page"),
				'url'      => '#',
				'visible'  => true,
				'active'   => in_array($controller, ['answer', 'advice', 'share']) && $action > 0,
				'icon'     => 'fa-file-powerpoint-o',
				'children' => [
				]
			],
			/*Page*/
			/*contact*/
			[
				'name'     => __("admin/menu.contact"),
				'url'      => url_admin('contact'),
				'visible'  => CUser::checkRole([Admins::ROLE_SUPER_ADMIN, Admins::ROLE_ADMIN]),
				'icon'     => 'fa-bell-o',
				'children' => []
			],
			/*contact*/
			/*User*/
			[
				'name'     => __("admin/menu.users"),
				'url'      => '#',
				'visible'  => CUser::checkRole([Admins::ROLE_SUPER_ADMIN, Admins::ROLE_ADMIN]),
				'icon'     => 'fa-users',
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
			[
				'name'    => __("Video"),
				'url'     => url_admin('website/video'),
				'visible' => true,
				'icon'    => 'fa-rss-square',
			],
			/*Website*/
			[
				'name'     => __("admin/menu.website"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'fa-rss-square',
				'children' => [
					[
						'name'    => __("admin/menu.config"),
						'url'     => url_admin('website/config'),
						'visible' => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'    => 'fa-home',
					],
					[
						'name'    => __("admin/menu.slide"),
						'url'     => url_admin('slide'),
						'visible' => true,
						'icon'    => 'fa-rss-square',
					],
					[
						'name'    => __("admin/menu.content message website"),
						'url'     => url_admin('website/message'),
						'visible' => false,
						'icon'    => 'fa-columns',
					],
					[
						'name'    => __("admin/menu.menu"),
						'url'     => url_admin('menu'),
						'visible' => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'    => 'fa-bars',
					],
					[
						'name'    => __("admin/menu.comment"),
						'url'     => url_admin('comment'),
						'visible' => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'    => 'fa-bars',
					]
				]
			],
			/*Website*/
			/*Setting*/
			[
				'name'     => __("admin/menu.setting"),
				'url'      => url_admin('setting'),
				'visible'  => CUser::checkRole([Admins::ROLE_SUPER_ADMIN, Admins::ROLE_ADMIN]),
				'icon'     => 'fa-cog',
				'children' => []
			],
			/*Setting*/
			/*Setting*/
			[
				'name'     => __("Refresh Cache"),
				'url'      => url_admin('refresh-cache'),
				'visible'  => true,
				'icon'     => 'fa-cog',
				'children' => []
			],
			/*Setting*/
		];
	}
}
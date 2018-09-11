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
	 */
	public static function render() {
		View::share('menus', (new AdminMenu)->menu());
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
			/*Product*/
			[
				'name'     => __("admin/menu.Product"),
				'url'      => url_admin('product/detail'),
				'visible'  => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
				'icon'     => 'fa-rocket',
				'children' => []
			],
			/*Product*/
			/*Order*/
			[
				'name'     => __("admin/menu.order"),
				'url'      => url_admin('order'),
				'active'   => $controller == 'order',
				'visible'  => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
				'icon'     => 'fa-inbox',
				'children' => []
			],
			/*Order*/
			/*News*/
			[
				'name'     => __('admin/menu.News'),
				'url'      => '#',
				'visible'  => true,
				'active'   => $controller == 'news' && $action > 0,
				'icon'     => 'fa-bullhorn',
				'children' => [
					[
						'name'    => __('admin/menu.list_news'),
						'url'     => url_admin('news'),
						'visible' => true,
						'icon'    => 'fa-bullhorn',
					],
					[
						'name'    => __('admin/menu.add_news'),
						'url'     => url_admin('news/create'),
						'visible' => true,
						'icon'    => 'fa-plus',
					],
					[
						'name'    => __("admin/menu.setting_banner"),
						'url'     => url_admin('news/banner'),
						'visible' => true,
						'icon'    => 'fa-plus',
					],
				]
			],
			/*News*/
			/*Post*/
			[
				'name'     => __("admin/menu.post"),
				'url'      => '#',
				'visible'  => true,
				'icon'     => 'glyphicon-pushpin',
				'active'   => in_array($controller, ['post', 'category', 'expert']) && $action > 0,
				'children' => [
					/*Post*/
					[
						'name'     => __("admin/menu.post by category"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'glyphicon-pushpin',
						'active'   => $controller == 'post' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('post'),
								'visible' => true,
								'icon'    => 'glyphicon-pushpin',
							],
							[
								'name'    => __("admin/menu.add_new"),
								'url'     => url_admin('post/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						],
					],
					/*Category*/
					[
						'name'     => __("admin/menu.category"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-list-alt',
						'active'   => $controller == 'category' && $action > 0,
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
					/*Expert*/
					[
						'name'     => __("admin/menu.post expert"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-slideshare',
						'active'   => $controller == 'expert' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('expert'),
								'visible' => true,
								'icon'    => 'fa-slideshare',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('expert/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Expert*/
				]
			],
			/*Post*/
			/*System Store*/
			[
				'name'     => __("admin/menu.system_store"),
				'url'      => '#',
				'visible'  => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
				'icon'     => 'fa-globe',
				'active'   => $controller == in_array($controller, [
						'store',
						'area',
						'category-city',
						'category-district',
						'category-street'
					]) && $action > 0,
				'children' => [
					/*Store*/
					[
						'name'     => __("admin/menu.store"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-cube',
						'active'   => $controller == 'store' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list store"),
								'url'     => url_admin('store'),
								'visible' => true,
								'icon'    => 'fa-cube',
							],
							[
								'name'    => __("admin/menu.add store"),
								'url'     => url_admin('store/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Store*/
					/*Area*/
					[
						'name'     => __("admin/menu.area"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-globe',
						'active'   => $controller == 'area' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('area'),
								'visible' => true,
								'icon'    => 'fa-globe',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('area/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Area*/
					/*City*/
					[
						'name'     => __("admin/menu.city"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-cab',
						'active'   => $controller == 'category-city' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('category-city'),
								'visible' => true,
								'icon'    => 'fa-cab',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('category-city/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*City*/
					/*District*/
					[
						'name'     => __("admin/menu.district"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'fa-building',
						'active'   => $controller == 'category-district' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('category-district'),
								'visible' => true,
								'icon'    => 'fa-building',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('category-district/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*District*/
					/*Street*/
					[
						'name'     => __("admin/menu.street"),
						'url'      => '#',
						'visible'  => true,
						'icon'     => 'glyphicon-road',
						'active'   => $controller == 'category-street' && $action > 0,
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('category-street'),
								'visible' => true,
								'icon'    => 'glyphicon-road',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('category-street/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Street*/
				]
			],
			/*System Store*/
			/*Page*/
			[
				'name'     => __("admin/menu.page"),
				'url'      => '#',
				'visible'  => true,
				'active'   => in_array($controller, ['answer', 'advice', 'share']) && $action > 0,
				'icon'     => 'fa-file-powerpoint-o',
				'children' => [
					/*Q & A*/
					[
						'name'     => __("admin/menu.q & a"),
						'url'      => url_admin('answer'),
						'visible'  => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'     => 'fa-question-circle',
						'children' => []
					],
					/*Q & A*/
					/*Advice*/
					[
						'name'     => __("admin/menu.advices"),
						'url'      => '#',
						'active'   => $controller == 'advice',
						'visible'  => true,
						'icon'     => 'fa-toggle-right',
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('advice'),
								'visible' => true,
								'icon'    => 'fa-toggle-right',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('advice/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Advice*/
					/*Share*/
					[
						'name'     => __("admin/menu.share experience"),
						'url'      => '#',
						'visible'  => true,
						'active'   => $controller == 'share',
						'icon'     => 'fa-share-alt',
						'children' => [
							[
								'name'    => __("admin/menu.list"),
								'url'     => url_admin('share'),
								'visible' => true,
								'icon'    => 'fa-share-alt',
							],
							[
								'name'    => __("admin/menu.add"),
								'url'     => url_admin('share/create'),
								'visible' => true,
								'icon'    => 'fa-plus',
							],
						]
					],
					/*Share*/
				]
			],
			/*Page*/
			/*Consultation & contact*/
			[
				'name'     => __("admin/menu.consultation and contact"),
				'url'      => '#',
				'visible'  => CUser::checkRole([Admins::ROLE_SUPER_ADMIN, Admins::ROLE_ADMIN]),
				'icon'     => 'fa-bell-o',
				'children' => [
					[
						'name'    => __("admin/menu.consultation"),
						'url'     => url_admin('website/subscribe'),
						'visible' => true,
						'icon'    => 'fa-bell-o',
					],
					[
						'name'    => __("admin/menu.contact"),
						'url'     => url_admin('website/contact'),
						'visible' => true,
						'icon'    => 'fa-linode',
					],
				]
			],
			/*Consultation & contact*/
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
						'name'    => __("admin/menu.information expert"),
						'url'     => url_admin('website/info-expert'),
						'visible' => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'    => 'fa-bars',
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
						'visible' => true,
						'icon'    => 'fa-columns',
					],
					[
						'name'    => __("admin/menu.menu"),
						'url'     => url_admin('menu'),
						'visible' => CUser::checkRole(Admins::ROLE_ALL, Admins::ROLE_AUTHOR),
						'icon'    => 'fa-bars',
					],
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
		];
	}
}
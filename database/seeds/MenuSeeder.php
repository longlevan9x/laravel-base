<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 * @throws Exception
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('menu_translations')->truncate();
		DB::table('menus')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		$menu             = new \App\Models\Menu;
		$menu->name       = "Tin tức";
		$menu->is_active  = 1;
		$menu->url        = 'tin-tuc';
		$menu->sort_order = 1;
		$menu->save();
		$menu             = new \App\Models\Menu;
		$menu->name       = "Bán hàng";
		$menu->is_active  = 1;
		$menu->url        = 'san-pham';
		$menu->sort_order = 1;
		$menu->save();
		$menu             = new \App\Models\Menu;
		$menu->name       = "Ý kiến khách hàng";
		$menu->is_active  = 1;
		$menu->url        = 'y-kien-khach-hang';
		$menu->sort_order = 1;
		$menu->save();
		$menu             = new \App\Models\Menu;
		$menu->name       = "Tuyển dụng";
		$menu->is_active  = 1;
		$menu->url        = 'tuyen-dung';
		$menu->sort_order = 1;
		$menu->save();
		$menu             = new \App\Models\Menu;
		$menu->name       = "Dịch vụ";
		$menu->is_active  = 1;
		$menu->url        = 'dich-vu';
		$menu->sort_order = 1;
		$menu->save();
		$menu             = new \App\Models\Menu;
		$menu->name       = "Giới thiệu";
		$menu->is_active  = 1;
		$menu->url        = 'gioi-thieu';
		$menu->sort_order = 1;
		$menu->save();
	}
}

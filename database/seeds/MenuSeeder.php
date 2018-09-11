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
		$menu             = new \App\Models\Category();
		$menu->name      = "Tin Tức";
		$menu->is_active  = 1;
		$menu->slug       = 'tin-tuc';
		$menu->sort_order = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Sản phẩm";
		$menu->is_active  = 1;
		$menu->slug       = 'san-pham';
		$menu->sort_order = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Các loại bệnh";
		$menu->is_active  = 1;
		$menu->type       = 'category';
		$menu->slug       = '#';
		$menu->sort_order = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Chia sẻ của mẹ";
		$menu->slug       = 'chia-se';
		$menu->sort_order = 2;
		$menu->is_active  = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Chuyên gia";
		$menu->slug       = 'chuyen-gia';
		$menu->sort_order = 2;
		$menu->is_active  = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Hỏi đáp";
		$menu->slug       = 'hoi-dap';
		$menu->sort_order = 2;
		$menu->is_active  = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Hệ thống nhà thuốc";
		$menu->slug       = 'he-thong-nha-thuoc';
		$menu->sort_order = 2;
		$menu->is_active  = 1;
		$menu->save();

		$menu             = new \App\Models\Category();
		$menu->name      = "Đặt hàng";
		$menu->slug       = 'dat-hang';
		$menu->sort_order = 2;
		$menu->is_active  = 1;
		$menu->save();
	}
}

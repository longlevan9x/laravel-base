<?php

use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('roles')->truncate();
		DB::table('abilities')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		$abilities = [
			'role-index',
			'role-show',
			'role-create',
			'role-edit',
			'role-destroy',
			'admin-index',
			'admin-show',
			'admin-create',
			'admin-edit',
			'admin-destroy',
			'category-index',
			'category-show',
			'category-create',
			'category-edit',
			'category-destroy',
			'contact-index',
			'contact-show',
			'contact-create',
			'contact-edit',
			'contact-destroy',
			'config-read',
			'config-edit',
			'menu-index',
			'menu-show',
			'menu-create',
			'menu-edit',
			'menu-destroy',
			'user-index',
			'user-show',
			'user-create',
			'user-edit',
			'user-destroy',
			'website-config',
			'admin-setting',
			/*can remove*/
			'tag-index',
			'tag-show',
			'tag-create',
			'tag-edit',
			'tag-destroy',
			'post-index',
			'post-show',
			'post-create',
			'post-edit',
			'post-destroy',
		];
		foreach ($abilities as $ability) {
			Bouncer::ability(['name' => $ability])->save();
		}
		Bouncer::allow('admin')->to($abilities);
		Bouncer::assign('admin')->to(\App\Models\Admins::whereUsername('admin')->first());
	}
}

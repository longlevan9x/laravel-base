<?php

use App\Commons\CConstant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run() {
		$model            = new \App\User;
		$model->username  = 'user';
		$model->name      = 'user';
		$model->email     = 'user@gmail.com';
		$model->is_active = CConstant::STATE_ACTIVE;
		$model->password  = bcrypt(123456);
		$model->role      = CConstant::ROLE_ADMIN;
		$model->save();
	}
}

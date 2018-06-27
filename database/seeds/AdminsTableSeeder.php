<?php

use App\Commons\CConstant;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $model            = new \App\Models\Admins();
	    $model->username  = 'admin';
	    $model->name      = 'admin';
	    $model->email     = 'admin@gmail.com';
	    $model->is_active = CConstant::STATE_ACTIVE;
	    $model->password  = bcrypt(123456);
	    $model->role      = CConstant::ROLE_ADMIN;
	    $model->save();
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->tinyInteger('role')->length(2)->nullable();
            $table->tinyInteger('is_active')->default(0)->nullable();
            $table->tinyInteger('is_online')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('Male, Female, ...');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->text('overview')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

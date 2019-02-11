<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenus extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('menus', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('url')->nullable();
			$table->tinyInteger('sort_order')->default(0)->nullable();
			$table->string('type', 20)->default('link');
			$table->tinyInteger('is_active')->default(0)->nullable()->length(2);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menus');
	}
}

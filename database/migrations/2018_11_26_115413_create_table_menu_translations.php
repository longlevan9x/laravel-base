<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenuTranslations extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('menu_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('menu_id')->unsigned();
			$table->string('name');
			$table->timestamps();
			$table->string('locale')->index();

			$table->unique(['menu_id', 'locale']);
			$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menu_translations');
	}
}

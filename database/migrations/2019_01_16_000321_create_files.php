<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiles extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id');
			$table->string('original_name');
			$table->string('base_name');
			$table->string('original_extension', 30)->nullable();
			$table->float('size', 8)->nullable()->default(0);
			$table->string('mine_type', 20)->nullable();
			$table->string('entity', 200)->nullable();
			$table->integer('entity_id')->unsigned()->nullable()->default(0);
			$table->string('description', 200)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('files');
	}
}

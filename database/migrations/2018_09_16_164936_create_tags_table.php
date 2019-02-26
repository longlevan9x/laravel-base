<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->nullable();
			$table->string('description', 500)->nullable();
			$table->tinyInteger('is_active')->default(0)->nullable();
			$table->string('type')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('tags');
	}
}

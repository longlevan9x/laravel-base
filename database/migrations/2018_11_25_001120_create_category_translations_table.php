<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up() {
		Schema::create('category_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->default(0)->unsigned();
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('seo_title', 500)->nullable();
			$table->string('seo_keyword', 500)->nullable();
			$table->text('seo_description')->nullable();
			$table->timestamps();

			$table->string('locale')->index();

			$table->unique(['category_id', 'locale']);
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('category_translations');
	}
}

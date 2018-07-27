<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table) {
        	$table->increments('id');
        	$table->integer('parent_id')->default(0);
        	$table->string('image')->nullable();
        	$table->string('name');
        	$table->string('slug')->nullable();
        	$table->tinyInteger('is_active')->default(0);
        	$table->string('status', 50)->nullable();
        	$table->string('description')->nullable();
        	$table->string('path')->nullable()->comment('folder file');
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
        //
    }
}

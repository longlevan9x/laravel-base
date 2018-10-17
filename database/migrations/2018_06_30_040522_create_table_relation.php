<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function(Blueprint $table) {
        	$table->increments('id');
        	$table->integer('relation1_id')->default(0)->default(0)->nullable();
        	$table->integer('relation2_id')->default(0)->default(0)->nullable();
        	$table->string('relation_type')->nullable();
        	$table->timestamps();
        	$table->unique(['relation1_id', 'relation2_id', 'relation_type']);
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

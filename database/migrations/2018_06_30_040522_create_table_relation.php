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
        Schema::create('relationship', function(Blueprint $table) {
        	$table->increments('id');
        	$table->integer('object1_id')->default(0)->default(0)->nullable();
        	$table->string('object1_type', 50)->nullable();
        	$table->integer('object2_id')->default(0)->default(0)->nullable();
	        $table->string('object2_type', 50)->nullable();
        	$table->string('relation_type')->nullable();
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

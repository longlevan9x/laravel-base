<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Course extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            //
            $table->increments('id')->unsigned();
            $table->string('code', 6)->nullable();
            $table->string('name', 100);
            $table->integer('id_department')->nullable()->unsigned();;
	        $table->integer('total_student')->default(0)->nullable();
	        $table->tinyInteger('is_active')->default(0)->nullable()->comment('trang thai hoat dong');
	        $table->foreign('id_department')->references('id')->on('departments');
            $table->timestamps();
        });

	    Schema::table('students', function (Blueprint $table) {
		    $table->foreign('id_course')->references('id')->on('courses');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            //
        });
    }
}

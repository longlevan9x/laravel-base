<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->increments('id')->length(11)->unsigned();
            $table->integer('student_id')->length(11)->unsigned();
            $table->integer('schedule_id')->length(11)->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->timestamps();
            $table->unique(['student_id', 'schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_schedules', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentScheduleExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schedule_exams', function (Blueprint $table) {
            //
            $table->increments('id')->length(11)->unsigned();
            $table->integer('student_id')->length(11)->unsigned();
            $table->integer('schedule_exam_id')->length(11)->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::table('student_schedule_exams', function (Blueprint $table) {
            //
        });
    }
}

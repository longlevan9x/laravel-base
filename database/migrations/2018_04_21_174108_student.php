<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            //
            $table->increments('id')->length(11)->unsigned();
            $table->string('code', 15)->unique();
            $table->string('name', 100);
            $table->string('class', 50)->nullable();
            $table->integer('id_course')->length(10)->unsigned()->nullable()->comment('khoa hoc');
            $table->string('branch_group', 50)->nullable()->comment('Nganh');
            $table->string('branch', 50)->nullable()->comment('Chuyen nganh');
            $table->string('status', 40)->nullable()->comment('trang thai');
            $table->string('day_admission', 50)->nullable()->comment('ngay vao truong');
            $table->string('school_year', 20)->nullable()->comment('nien khoa');
            $table->integer('id_department')->nullable()->unsigned()->comment('khoa');
            $table->string('education_level', 20)->nullable()->comment('bac dao tao');
            $table->string('gender' , 15)->nullable()->comment('gioi tinh');
            $table->string('type_education')->nullable()->comment('Loai hinh dao tao');
            $table->tinyInteger('area')->nullable()->comment('Co so:10->hanoi, 20->namdinh');
            $table->string('average_cumulative', 30)->nullable()->comment('trung binh tich luy');
            $table->integer('total_term')->nullable()->comment('tong so tin chi');
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
        Schema::table('student', function (Blueprint $table) {
            //
        });
    }
}

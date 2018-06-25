<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Schedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            //
            $table->increments('id')->length(11)->unsigned();
            $table->string('code')->unique()->comment('ma lop hoc phan');
            $table->string('name')->nullable()->comment('ten mon hoc');
            $table->string('semester')->nullable()->comment('hoc ky');
            $table->string('lesson', 100)->nullable()->comment('tiet hoc');
            $table->date('start_time')->nullable()->comment('thoi gian bat dau');
            $table->date('end_time')->nullable()->comment('thoi gian ket thuc');
            $table->string('weekday', 30)->default(0)->nullable()->comment('ngay trong tuan');
            $table->string('session', 30)->nullable()->comment('ca hoc');
            $table->string('teacher')->nullable()->comment('giang vien');
            $table->string('classroom', 30)->nullable()->comment('phòng học');
            $table->tinyInteger('is_active')->default(1)->nullable()->comment('trang thai hoat dong');
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
        Schema::table('schedule', function (Blueprint $table) {
            //
        });
    }
}

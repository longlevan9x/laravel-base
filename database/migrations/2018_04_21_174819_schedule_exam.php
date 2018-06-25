<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScheduleExam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_exams', function (Blueprint $table) {
            //
            $table->increments('id')->unsigned();
            $table->string('code')->unique()->comment('ma lop hoc phan');
            $table->string('name')->comment('ten mon thi');
            $table->integer('group')->nullable()->comment('nhom');
            $table->string('test_day')->nullable()->comment('ngay thi');
            $table->string('serial')->nullable()->comment('si so');
            $table->string('semester')->nullable()->comment('ky thi');
            $table->string('examination')->nullable()->comment('tiet thi');
            $table->string('room')->nullable()->comment('phong thi');
            $table->string('type')->nullable()->comment('loai thi');
            $table->string('note')->nullable()->comment('ghi chu');
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
        Schema::table('schedule_exam', function (Blueprint $table) {
            //
        });
    }
}

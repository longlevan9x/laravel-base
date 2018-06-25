<?php

namespace App\Models\Providers;

use App\Models\StudentSchedule;
use App\Models\StudentScheduleExam;
use Illuminate\Support\ServiceProvider;

class StudentScheduleExamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('student-schedule-exam', function () {
           return new StudentScheduleExam();
        });
    }
}

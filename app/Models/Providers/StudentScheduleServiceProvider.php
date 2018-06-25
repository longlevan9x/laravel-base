<?php

namespace App\Models\Providers;

use App\Models\StudentSchedule;
use Illuminate\Support\ServiceProvider;

class StudentScheduleServiceProvider extends ServiceProvider
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
        $this->app->singleton('student-schedule', function () {
           return new StudentSchedule();
        });
    }
}

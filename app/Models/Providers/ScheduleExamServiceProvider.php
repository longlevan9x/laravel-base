<?php

namespace App\Models\Providers;

use App\Models\ScheduleExam;
use Illuminate\Support\ServiceProvider;

class ScheduleExamServiceProvider extends ServiceProvider
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
        $this->app->singleton('schedule-exam', function () {
            return new ScheduleExam();
        });
    }
}

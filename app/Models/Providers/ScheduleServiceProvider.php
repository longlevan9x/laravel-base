<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/12/2018
 * Time: 12:19 AM
 */

namespace App\Models\Providers;


use App\Models\Schedule;
use Illuminate\Support\ServiceProvider;

/**
 * Class ScheduleServiceProvider
 * @package App\Models\Providers
 */
class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('schedule', function () {
            return new Schedule();
        });
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/10/2018
 * Time: 11:03 AM
 */

namespace App\Models\Providers;


use App\Models\Student;
use Illuminate\Support\ServiceProvider;

/**
 * Class StudentServiceProvider
 * @package App\Models\Providers
 */
class StudentServiceProvider extends ServiceProvider
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
        $this->app->singleton('student', function () {
            return new Student();
        });
    }
}
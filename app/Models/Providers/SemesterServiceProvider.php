<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/24/2018
 * Time: 9:39 AM
 */

namespace App\Models\Providers;


use App\Models\Semester;
use Illuminate\Support\ServiceProvider;

/**
 * Class SemesterServiceProvider
 * @package App\Models\Providers
 */
class SemesterServiceProvider extends ServiceProvider
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
        $this->app->singleton('semester', function() {
            return new Semester();
        });
    }
}
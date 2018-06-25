<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/12/2018
 * Time: 12:20 AM
 */

namespace App\Models\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Student
 * @package App\Models\Facade
 * @method static string syncScheduleByDepartment(string $department_code)
 * @see \App\Models\Schedule
 */
class Schedule extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'schedule';
    }
}
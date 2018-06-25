<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/18/2018
 * Time: 2:23 PM
 */

namespace App\Models\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class ScheduleExam
 * @package App\Models\Facade
 * @method static string syncScheduleExamByDepartment(string $department_code)
 * @see \App\Models\ScheduleExam
 */
class ScheduleExam extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'schedule-exam';
    }
}
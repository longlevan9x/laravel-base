<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/19/2018
 * Time: 11:35 AM
 */

namespace App\Models\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Student
 * @package App\Models\Facade
 * @method static string syncStudentScheduleExamByDepartment($department_code)
 * @see \App\Models\StudentScheduleExam
 */
class StudentScheduleExam extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'student-schedule-exam';
    }
}
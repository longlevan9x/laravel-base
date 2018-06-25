<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/10/2018
 * Time: 11:03 AM
 */

namespace App\Models\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Student
 * @package App\Models\Facade
 * @method static string syncStudentByDepartment($department_code)
 * @method static string syncStudent(int $msv)
 * @see \App\Models\Student
 */
class Student extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'student';
    }
}
<?php

namespace App\Models;

use App\Crawler\LichThi;
use App\Helpers\Facade\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Yadakhov\InsertOnDuplicateKey;

class ScheduleExam extends Model
{
    use InsertOnDuplicateKey;
    protected $fillable = ['code', 'name', 'group', 'test_day', 'examination', 'room', 'type', 'note', 'is_active'];

    /**
     * @param $department_code
     * @throws \Exception
     */
    public function syncScheduleExamByDepartment($department_code) {
        /** @var Department $department */
        $department = Department::where(['code' => $department_code])->first();
        if (isset($department) && !empty($department)) {
            set_time_limit(0);
            $scheduleExams = [];

            $lichThi = new LichThi();
            $msv = $department->code;
            $total_student = $department->total_student;
//            $total_student = 200;

            for ($index = 1; $index <= $total_student; $index++) {
                $lichThi->msv = Helper::getMsv($msv, $index);
                $scheduleExam = $lichThi->getLichThi('3 (2017 - 2018)')->asArray();
                $scheduleExams += $scheduleExam;
            }

//            echo "<pre>";
//            print_r($scheduleExams);
//            print_r(array_values($scheduleExams));
//            die;
            ScheduleExam::insertOnDuplicateKey(array_values($scheduleExams));
        }
    }
}

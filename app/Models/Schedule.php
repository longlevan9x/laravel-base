<?php

namespace App\Models;

use App\Commons\CConstant;
use App\Crawler\LichHoc;
use App\Helpers\Facade\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\DB;
use Yadakhov\InsertOnDuplicateKey;

class Schedule extends Model
{
    use InsertOnDuplicateKey;

    protected $fillable = ['code','name','semester','lesson','start_time','end_time','weekday','session','teacher','classroom','is_active'];

    /**
     * @param $department_code
     * @throws \Exception
     */
    public function syncScheduleByDepartment($department_code) {
        /** @var Department $department */
        $department = Department::where(['code' => $department_code])->first();
        if (isset($department) && !empty($department)) {
            set_time_limit(0);
            $schedules = [];

            $lichHoc = new LichHoc();
            $msv = $department->code;
            $total_student = $department->total_student;
//            $total_student = 200;

            for ($index = 1; $index <= $total_student; $index++) {
                $lichHoc->msv = Helper::getMsv($msv, $index);
                $schedule = $lichHoc->getLichHoc()->asArray();
                $schedules += $schedule;
            }

//            echo "<pre>";
//            print_r(array_values($schedules));
//            print_r($schedules);
//            die;
            Schedule::insertOnDuplicateKey(array_values($schedules));

            $syncHistory = new SyncHistory();
            $syncHistory->name = Schedule::getTableName();
            $syncHistory->type = 'web';
            $syncHistory->total_record = count($schedules);
	        $syncHistory->status = CConstant::STATE_ACTIVE;
            $syncHistory->save();
        }
    }
}

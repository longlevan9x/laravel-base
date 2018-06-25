<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facade\StudentSchedule;
use App\Models\Facade\StudentScheduleExam;
use Illuminate\Http\Request;

/**
 * Class SyncController
 * @package App\Http\Controllers\Admin
 */
class SyncController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.sync.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function syncStudentScheduleByDepartment(Request $request) {
        StudentSchedule::syncStudentScheduleByDepartment($request->get('id_department'));
        return redirect('admin/sync');
    }


    public function syncStudentScheduleExamByDepartment(Request $request){
        StudentScheduleExam::syncStudentScheduleExamByDepartment($request->get('id_department'));
        return redirect('admin/sync');
    }
}

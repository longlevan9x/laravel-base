<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Admin\Controller;
use App\Models\Facade\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * default is student k8
     * @param $msv
     */
    public function syncStudent($msv)
    {
        Student::syncStudent($msv);
    }

    /**
     * default is student k8
     * @param int $department_code
     */
    public function syncStudents($department_code = 141031)
    {
        Student::syncStudentByDepartment(141031);
    }

    /**
     * @param $msv
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudent($msv)
    {
        $student = Student::where(['code' => $msv])->first();
        if (!isset($student) || empty($student)) {
            return response()->json([
                'message' => 'student not found',
                'status'  => 404,
                'result'  => $student
            ], 404);
        }

        return response()->json([
            'message' => 'success',
            'status'  => 200,
            'result'  => $student
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStudents(Request $request)
    {
        $limit = $request->get('per_page', 10);
        return response()->json([
            'message' => 'success',
            'status'  => 200,
            'result'  => \App\Models\Student::paginate($limit)
        ], 200);
    }

    /**
     * @param $department_id
     */
    public function getStudentByDepartment($department_id) {

    }
}

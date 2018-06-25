<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $models = Course::all();
	    return view('admin.course.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
	    Course::create($request->all());
	    return redirect(route(CourseController::getAdminRouteName()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 * @param Course $course
	 * @return \Illuminate\Http\Response
	 */
    public function edit(Course $course)
    {
	    $model = $course;
	    $models = Course::all();
	    return view('admin.course.index', compact('models', 'model'));
    }

	/**
	 * Update the specified resource in storage.
	 * @param CourseRequest $request
	 * @param Course        $course
	 * @return \Illuminate\Http\Response
	 */
    public function update(CourseRequest $request, Course $course)
    {
	    $course->update($request->all());
	    return redirect(self::getUrlAdmin());
    }

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Course $course)
    {
	    $course->delete();
	    return redirect(route('department'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SemesterRequest;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Semester::all();

		return view('admin.semester.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  SemesterRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(SemesterRequest $request) {
		Semester::create($request->all());

		return redirect(url('admin/semester'));
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param $semester
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Semester $semester) {
		$model  = $semester;
		$models = Semester::all();

		return view('admin.semester.index', compact('models', 'model'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param SemesterRequest $request
	 * @param Semester        $semester
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(SemesterRequest $request, Semester $semester) {
		$semester->update($request->all());

		return redirect(url('admin/semester'));
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function syncSemester() {
		\App\Models\Facade\Semester::syncSemester();

		return redirect(route('semester.index'));
	}
}

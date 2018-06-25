<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\FileHelpers;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Department::all();
        return view('admin.department.index', compact('models'));
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
     * @param  DepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        Department::create($request->all());
        return redirect(route('department.index'));
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
     *
     * @param $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $model = $department;
        $models = Department::all();
        return view('admin.department.index', compact('models', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->all());
        return redirect(url('admin/department'));
        //
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Department $department
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect(route('department'));
    }
}

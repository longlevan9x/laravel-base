<?php

namespace App\Http\Controllers\Admin;


class DashboardController extends Controller
{
	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
		parent::__construct();
	}

	/**
	 * Show the application dashboard.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return view('admin.dashboard.index');
	}

}

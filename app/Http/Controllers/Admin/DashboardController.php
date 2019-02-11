<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use App\Models\OrderItemExpand;
use Illuminate\Database\Query\Builder;

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
		$totalPost    = 0;
		$totalNews    = 0;

		return view('admin.dashboard.index', compact('totalPost', 'totalNews'));
	}

}

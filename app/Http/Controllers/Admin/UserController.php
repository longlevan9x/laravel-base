<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct(User $user) {
		$this->model = $user;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = User::all();

		return view('admin.user.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = $this->model;

		return view('admin.user.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request) {
		$this->before(__FUNCTION__);
		$model = $this->model;
		$model->fill($request->all());
		$check = $model->save();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $model);
	}

	/**
	 * Display the specified resource.
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		$this->before(__FUNCTION__);
		$model = $user;

		return view('admin.user.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param User $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(User $user) {
		$this->before(__FUNCTION__);
		$model = $user;

		return view('admin.user.update', compact('model'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @param User                      $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, User $user) {
		$this->before(__FUNCTION__);
		$user->fill($request->all());
		$check = $user->save();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $user);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(User $user) {
		$this->before(__FUNCTION__);
		$check = $user->delete();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $user);
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Bouncer;
use Silber\Bouncer\Database\Role;

class RoleController extends Controller
{
	protected $abilities;

	/**
	 * RoleController constructor.
	 * @param Role $role
	 */
	public function __construct(Role $role) {
		parent::__construct();
		$this->model     = $role;
		$this->abilities = Bouncer::Ability()->all();
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = Bouncer::Role()->with('abilities')->get();

		return view('admin.role.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$abilities = $this->abilities;
		$model     = $this->model;

		return view('admin.role.create', compact('abilities', 'model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request) {
		$this->before(__FUNCTION__);
		$check = Bouncer::allow($request->name)->to($request->ability_ids);
		Bouncer::role()->update(['title' => $request->title, /*'level' => $request->level*/]);

		return $this->redirectWithMessage(self::getUrlAdmin(), $check, 'success', 'fail');
	}

	/**
	 * Display the specified resource.
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$this->before(__FUNCTION__);
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Role $role
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Role $role) {
		$this->before(__FUNCTION__);
		$model     = $role;
		$abilities = $this->abilities;

		return view('admin.role.update', compact('model', 'abilities'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @param Role                      $role
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, Role $role) {
		$this->before(__FUNCTION__);
		$check = $role->update(['name' => $request->name, 'title' => $request->title, /*'level' => $request->level ?? 1*/]);

		$role->abilities()->sync($request->ability_ids);

		return $this->redirectWithMessage(self::getUrlAdmin(), $check, 'success', 'fail');
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Role $role
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Role $role) {
		$this->before(__FUNCTION__);
		if ($role->id == 1) {
			throw new \Exception;
		}
		$check = $role->delete();

		return $this->redirectWithMessage(self::getUrlAdmin(), $check, 'success', 'fail');
	}
}

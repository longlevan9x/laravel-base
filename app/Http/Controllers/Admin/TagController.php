<?php

namespace App\Http\Controllers\Admin;

use App\Commons\CConstant;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = Tag::all();
		$model  = new Tag;

		return view('admin.tag.index', compact('models', 'model'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = new Tag;

		return view('admin.tag.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function store(Request $request) {
		$this->before(__FUNCTION__);
		$model = new Tag($request->all());
		$check = $model->save();
		if (!$request->ajax()) {
			return $this->redirectWithModel(self::getUrlAdmin(), $check, $model);
		}

		return responseJson($check ? CConstant::STATUS_SUCCESS : CConstant::STATUS_ERROR);
	}

	/**
	 * Display the specified resource.
	 * @param Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tag $tag) {
		$this->before(__FUNCTION__);
		$model = $tag;

		return view('admin.tag.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param Tag $tag
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Tag $tag) {
		$this->before(__FUNCTION__);
		$model  = $tag;
		$models = Tag::all();

		return view('admin.tag.index', compact('model', 'models'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @param Tag                       $tag
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function update(Request $request, Tag $tag) {
		$this->before(__FUNCTION__);
		$tag->fill($request->all());
		$check = $tag->save();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $tag);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Tag $tag
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Tag $tag) {
		$this->before(__FUNCTION__);
		$check = $tag->delete();

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $tag);
	}

	/**
	 * @return Tag|mixed
	 */
	public function getModel() {
		return new Tag;
	}
}

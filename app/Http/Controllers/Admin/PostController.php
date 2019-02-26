<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
	protected $type;

	/**
	 * CategoryController constructor.
	 * @param Post $post
	 */
	public function __construct(Post $post) {
		parent::__construct();
		$this->model = $post;
		$type        = $this->type = request()->query('type', Post::TYPE_POST);
		view()->share(compact('type'));
		view()->share(['model' => $this->model]);
	}

	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$this->before(__FUNCTION__);
		$models = Post::query()->whereType($this->type)->withTranslation()->with(['category', 'author', 'authorUpdated'])->get();

		return view('admin.post.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->before(__FUNCTION__);
		$model = new Post;

		return view('admin.post.create', compact('model'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param PostRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(PostRequest $request) {
		$this->before(__FUNCTION__);
		$model = new Post($request->all());
		$model->setAuthorId();
		$check = $model->save();
		if ($check) {
			$model->relationships()->saveMultiple($request->tags, $model->id, Tag::table() . Post::table());
		}

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $model);
	}

	/**
	 * Display the specified resource.
	 * @param  mixed $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$this->before(__FUNCTION__);
		$model = Post::findOrFail($id);

		return view('admin.post.view', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param  mixed $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$this->before(__FUNCTION__);
		/** @var Post $model */
		$model   = Post::findOrFail($id);
		$tags    = $model->tags()->selectRaw("tags.id, tags.name as text")->get();
		$id_tags = $tags->pluck('id');
		$tags    = $tags->toJson();

		return view('admin.post.update', compact('model', 'tags', 'id_tags'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param PostRequest $request
	 * @param Post        $post
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(PostRequest $request, Post $post) {
		$this->before(__FUNCTION__);
		$post->fill($request->all());
		$post->setAuthorUpdatedId();
		$check = $post->save();
		if ($check) {
			$post->relationships()->saveMultiple($request->tags, $post->id, Tag::table() . Post::table());
		}

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $post);
	}

	/**
	 * Remove the specified resource from storage.
	 * @param Post $post
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Post $post) {
		$this->before(__FUNCTION__);
		$check = $post->delete();
		if ($check) {
			$post->relationships()->delete();
		}

		return $this->redirectWithModel(self::getUrlAdmin(), $check, $post);
	}
}

<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 12/17/2018
 * Time: 23:56
 */

namespace App\Models\Traits;

use App\Models\Relationship;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class ModelTagTrait
 * @package App\Models\Traits
 */
trait ModelTagTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags() {
		$table = call_user_func(get_called_class() . "::table");

		return $this->belongsToMany(Tag::class, Relationship::table(), 'relation2_id', 'relation1_id')->where('relation_type', Tag::table() . $table);
	}

	/**
	 * @param Request $request
	 */
	public function saveTags(Request $request) {
		/** @var Relationship $relationships */
		$relationships = $this->relationships();
		$relationships->saveMultiple($request->tags, $this->id, $this->relationType());
	}


	protected $_tags;

	/**
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
	 */
	public function getTags() {
		return $this->_tags = $this->tags()->selectRaw("tags.id, tags.name as text")->get();
	}

	/**
	 * @param Collection $tags
	 * @return mixed
	 */
	public function getIdTags($tags = null) {
		if ($tags == null) {
			$tags = $this->_tags;
		}

		return $tags->pluck('id');
	}

	/**
	 * @param Collection $tags
	 * @return mixed
	 */
	public function getTagsJson($tags = null) {
		if ($tags == null) {
			$tags = $this->_tags;
		}

		return $tags->toJson();
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 12/16/2018
 * Time: 17:02
 */

namespace App\Models\Traits;

use App\Models\Category;

/**
 * Trait ModelCategoryTrait
 * @package App\Models\Traits
 * @property Category category
 */
trait ModelCategoryTrait
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Category
	 */
	public function category() {
		return $this->belongsTo(Category::class)->withTranslation();
	}

	/**
	 * @return string
	 */
	public function getCategoryName() {
		return $this->getRelateValue($this->category, 'name', '-');
	}
}
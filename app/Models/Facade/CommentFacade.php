<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/26/2018
 * Time: 16:09
 */

namespace App\Models\Facade;


use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class SettingFacade
 * @package App\Models\Facade
 * @method static Setting getRecursiveComments(Collection $comments, int $parent_id = 0,array &$output = [],int $level = 0)
 * @see Setting
 */
class CommentFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'comment';
	}
}
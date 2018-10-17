<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 09/16/2018
 * Time: 17:50
 */

namespace App\Models\Interfaces;

/**
 * Interface IModelMeta
 * @package App\Models\Interfaces
 */
interface IModelMeta
{
	/**
	 * @return string
	 */
	public function fieldForeignKey();
}
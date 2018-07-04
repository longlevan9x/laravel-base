<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 07/03/2018
 * Time: 22:40
 */

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Trait ModelAuthTrait
 * @package App\Models\Traits
 * @property Model $this
 */
trait ModelAuthTrait
{
	public function generatePassword() {
		return $this->password = Hash::make($this->password);
	}
}
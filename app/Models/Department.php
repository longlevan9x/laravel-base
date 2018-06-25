<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * @package App\Models
 * @property int    code
 * @property string name
 * @property int    total_student
 * @property int    id
 */
class Department extends Model
{
	//
	/**
	 * @var array
	 */
	protected $fillable = ['name', 'is_active'];
}

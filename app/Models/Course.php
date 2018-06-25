<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * @package App\Models
 */
class Course extends Model
{
	/**
	 * @var array
	 */
	protected $fillable = ['code', 'id_department', 'name', 'total_student', 'is_active'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function department() {
    	return $this->belongsTo(Department::class, 'id_department', 'id');
    }
}

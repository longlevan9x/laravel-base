<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    $unique = 'courses';

	    if (intval($this->segment(3))) {
		    $unique .= ',code,'. $this->segment(3);
	    }

	    return [
		    'code' => "required|max:6|unique:$unique",
		    'name' => "required",
		    'is_active' => 'required|boolean',
		    'total_student' => 'integer'
	    ];
    }
}

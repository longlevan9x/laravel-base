<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AdminRequest
 * @package App\Http\Requests
 * @property string  $username
 * @property string  $name
 * @property string  $password
 * @property string  $email
 * @property string  $image
 * @property string  $status
 * @property string  $phone
 * @property string  $address
 * @property string  $overview
 * @property integer $role
 * @property integer $is_active
 * @property integer $is_online
 * @property integer $gender
 * @property mixed   $last_login
 * @property mixed   $last_logout
 * @property mixed   $created_at
 * @property mixed   $updated_at
 */
class AdminRequest extends FormRequest
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
	    $unique = 'admins';

	    if (intval($this->segment(3))) {
		    $unique .= ',id,'. $this->segment(3);
	    }

        return [
            'email' => "required|email|unique:$unique"
        ];
    }
}

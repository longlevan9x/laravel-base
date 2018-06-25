<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
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
class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'username', 'name', 'password', 'email', 'image', 'status', 'phone', 'address',
		'overview', 'role', 'is_active', 'is_online', 'gender', 'last_login', 'last_logout,'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}

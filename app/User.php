<?php

namespace App;

use App\Commons\Facade\CFile;
use App\Models\Traits\ModelAuthTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPasswordNotification;

/**
 * Class User
 *
 * @package App
 * @property string                                                     $username
 * @property string                                                     $name
 * @property string                                                     $password
 * @property string                                                     $email
 * @property string                                                     $image
 * @property string                                                     $status
 * @property string                                                     $phone
 * @property string                                                     $address
 * @property string                                                     $overview
 * @property integer                                                    $role
 * @property integer                                                    $is_active
 * @property integer                                                    $is_online
 * @property integer                                                    $gender
 * @property mixed                                                      $last_login
 * @property mixed                                                      $last_logout
 * @property mixed                                                      $created_at
 * @property mixed                                                      $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @property-read \App\Models\Admins $author
 * @property-read \App\Models\Admins $authorUpdated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User active($value = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User inActive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User orderBySortOrder()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User orderBySortOrderDesc()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User postTime($time = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($slug)
 * @property int $id
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastLogout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @property string|null $authen_key
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAuthenKey($value)
 */
class User extends Authenticatable
{
	use Notifiable;
	use ModelTrait;
	use ModelUploadTrait;
	use ModelAuthTrait;
	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'username',
		'name',
		'password',
		'email',
		'image',
		'status',
		'phone',
		'address',
		'overview',
		'role',
		'is_active',
		'is_online',
		'gender',
		'last_login',
		'last_logout',
		'authen_key'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function sendPasswordResetNotification($token) {
		$this->notify(new UserResetPasswordNotification($token));
	}


	public function getGenderLabel() {
		if ($this->gender == 1) {
			return view('admin.layouts.widget.labels.success', ['text' => __('admin.male')]);
		}

		return view('admin.layouts.widget.labels.info', ['text' => __('admin.female')]);
	}

	/**
	 * @return string
	 */
	public function getImagePath() {
		return CFile::getImageUrl($this->getTable(), $this->image, \App\Commons\CFile::DEFAULT_IMAGE_USER);
	}

	/**
	 * @return string
	 */
	public function getDefaultImage(): string {
		return 'user.png';
	}

	/**
	 * @param int $role
	 */
	public function setRole(int $role): void {
		if (empty($role)) {
			$this->role = 10;
		}
		else {
			$this->role = $role;
		}
	}
}

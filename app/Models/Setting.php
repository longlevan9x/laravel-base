<?php

namespace App\Models;

use App\Commons\CConstant;
use App\Commons\Facade\CFile;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Class Setting
 *
 * @package App\Models
 * @property string                  $website_name
 * @property string                  $website_description
 * @property string                  $admin_email
 * @property string                  $lang_default
 * @property string                  $format_time
 * @property string                  $format_date
 * @property string                  $format_datetime
 * @property string                  $blog_charset
 * @property string                  _message_order
 * @property string                  _message_order_success
 * @property string                  _message_order_fail
 * ======= method defined in ModelBaseTrait with function __call, __get, __set =======
 * @method setMaxLogoHeight(int $maxImageHeight)
 * @method setMaxLogoWidth(int $maxImageWidth)
 * @method setMax_expert_imageHeight(int $maxImageHeight)
 * @method setMax_expert_imageWidth(int $maxImageWidth)
 * @method setMax_expert_thumbnailWidth(int $maxImageHeight)
 * @method setMax_expert_thumbnailHeight(int $maxImageWidth)
 * @property int                     $id
 * @property int|null                $autoload
 * @property int|null                $is_active
 * @property Carbon|null             $created_at
 * @property Carbon|null             $updated_at
 * @property-read \App\Models\Admins $authorUpdated
 * @method static Builder|Setting findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Setting whereAutoload($value)
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereIsActive($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereSlug($slug)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @mixin \Eloquent
 * @property string|null             $key
 * @property string|null             $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting active($value = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting inActive()
 * @property-read \App\Models\Admins $author
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting orderBySortOrder()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting orderBySortOrderDesc()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting postTime($time = '')
 */
class Setting extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	use InsertOnDuplicateKey;
	const KEY_WEBSITE_NAME        = 'website_name';
	const KEY_WEBSITE_DESCRIPTION = 'website_description';
	const KEY_WEBSITE_ADDRESS     = 'website_address';
	const KEY_WEBSITE_PHONE       = 'website_phone';
	const KEY_WEBSITE_COPYRIGHT   = 'website_copyright';
	const KEY_WEBSITE_FAX         = 'website_fax';

	const KEY_ADMIN_EMAIL           = 'admin_email';
	const KEY_LANG_DEFAULT          = 'lang_default';
	const KEY_FORMAT_TIME           = 'format_time';
	const KEY_FORMAT_DATE           = 'format_date';
	const KEY_FORMAT_DATETIME       = 'format_datetime';
	const KEY_BLOG_CHARSET          = 'blog_charset';
	const KEY_LOGO                  = 'logo';
	const KEY_MESSAGE_ORDER         = '_message_order';
	const KEY_MESSAGE_ORDER_SUCCESS = '_message_order_success';
	const KEY_MESSAGE_ORDER_FAIL    = '_message_order_fail';
	/**
	 * @var array
	 */
	protected $fillable = ['key', 'value', 'is_active', 'autoload'];

	/**
	 * @var string
	 */
	public $logo = '';
	/**
	 * @var string
	 */
	public $website_name = '';
	/**
	 * @var string
	 */
	public $website_description = '';
	/**
	 * @var string
	 */
	public $admin_email = '';
	/**
	 * @var string
	 */
	public $lang_default = '';
	/**
	 * @var string
	 */
	public $format_time = '';

	/**
	 * @return string
	 */
	public function getFormatTime(): string {
		return $this->format_time;
	}

	/**
	 * @param string $format_time
	 */
	public function setFormatTime(string $format_time): void {
		$this->format_time = $format_time;
	}

	/**
	 * @return string
	 */
	public function getFormatDate(): string {
		return $this->format_date;
	}

	/**
	 * @param string $format_date
	 */
	public function setFormatDate(string $format_date): void {
		$this->format_date = $format_date;
	}

	/**
	 * @return string
	 */
	public function getFormatDatetime(): string {
		return $this->format_datetime;
	}

	/**
	 * @param string $format_datetime
	 */
	public function setFormatDatetime(string $format_datetime): void {
		$this->format_datetime = $format_datetime;
	}

	/**
	 * @return string
	 */
	public function getWebsiteName() {
		return $this->website_name;
	}

	/**
	 * @param string $website_name
	 */
	public function setWebsiteName(string $website_name): void {
		$this->website_name = $website_name;
	}

	/**
	 * @return string
	 */
	public function getLogo(): string {
		return $this->logo;
	}

	/**
	 * @param string $logo
	 */
	public function setLogo(string $logo): void {
		$this->logo = $logo;
	}

	/**
	 * @return string
	 */
	public function getWebsiteDescription(): string {
		return $this->website_description;
	}

	/**
	 * @param string $website_description
	 */
	public function setWebsiteDescription(string $website_description): void {
		$this->website_description = $website_description;
	}

	/**
	 * @return string
	 */
	public function getAdminEmail(): string {
		return $this->admin_email;
	}

	/**
	 * @param string $admin_email
	 */
	public function setAdminEmail(string $admin_email): void {
		$this->admin_email = $admin_email;
	}

	/**
	 * @return string
	 */
	public function getLangDefault(): string {
		return $this->lang_default;
	}

	/**
	 * @param string $lang_default
	 */
	public function setLangDefault(string $lang_default): void {
		$this->lang_default = $lang_default;
	}

	/**
	 * @return string
	 */
	public function getBlogCharset(): string {
		return $this->blog_charset;
	}

	/**
	 * @param string $blog_charset
	 */
	public function setBlogCharset(string $blog_charset): void {
		$this->blog_charset = $blog_charset;
	}


	/**
	 * @return Setting[]|bool|\Illuminate\Database\Eloquent\Collection
	 */
	public function loadModel() {
		if (env("APP_NAME") == null) {
			return false;
		}

		if (env("APP_KEY") == null) {
			return false;
		}

		$keyCache = config('common.cache.keys.settings');
		if (Cache::has($keyCache)) {
			return Cache::get($keyCache);
		}

		if (!Schema::hasTable('settings')) {
			return false;
		}
		$models = Setting::where('autoload', 1)->get();
		$models->map(function($item, $index) {
			/**@var Setting $item */
			$key   = $item->getAttribute('key');
			$value = $item->getAttribute('value');

			$this->setAttribute($key, $value);
			$this->{$key} = $value;
		});

		Cache::put($keyCache, $this, 120);

		return $models;
	}

	/**
	 * @param array|string $keys
	 * @return Setting
	 */
	public function loadModelByKey($keys = "") {
		if (!empty($keys)) {
			if (is_array($keys)) {
				$models = self::whereIn('key', $keys)->get();
			}
			else {
				/** @var self $model */
				$model = self::where('key', $keys)->first();
				if (isset($model) && !empty($model)) {
					$this->setAttribute($model->key, $model->value);
					$this->{$model->key} = $model->value;
				}

				return $this;
			}
		}
		else {
			$models = self::all();
		}

		$models->map(function($item, $index) {
			/**@var Setting $item */
			$key   = $item->getAttribute('key');
			$value = $item->getAttribute('value');

			$this->setAttribute($key, $value);
			$this->{$key} = $value;
		});

		return $this;
	}

	/**
	 * @param $key
	 * @return mixed
	 * @throws \Exception
	 */
	public function getValue($key) {
		$cacheKey = config('common.cache.keys.settings');
		if (Cache::has($cacheKey)) {
			/** @var Setting $models */
			$models    = Cache::get($cacheKey);
			$attribute = key_exists($key, $models);
			if (isset($attribute) && !empty($attribute)) {
				return $models->{$key};
			}
			else {
				if (isset($models->{$key})) {
					return $models->{$key};
				}
				else {
					return "";
					//					throw  new  \Exception("$key " . __('admin/common.not found'));
				}
			}
		}
		else {
			$this->loadModel();
			$attribute = key_exists($key, $this);
			if (isset($attribute) && !empty($attribute)) {
				return $this->{$key};
			}
			else {
				if (isset($this->{$key})) {
					return $this->{$key};
				}

				return "";
				//throw  new  \Exception("$key " . __('admin/common.not found'));
			}
		}
	}

	/**
	 * @return mixed
	 */
	public static function getModel() {
		if (!Cache::has(config('common.cache.keys.settings'))) {
			return (new static)->loadModel();
		}

		return Cache::get(config('common.cache.keys.settings'));
	}

	/**
	 * @param Request $request
	 */
	public function setModel(Request $request) {
		$this->lang_default    = $request->get(self::KEY_LANG_DEFAULT);
		$this->format_date     = $request->get(self::KEY_FORMAT_DATE);
		$this->format_time     = $request->get(self::KEY_FORMAT_TIME);
		$this->format_datetime = $request->get(self::KEY_FORMAT_DATETIME);
	}

	/**
	 * @param array $options
	 * @return int
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function save(array $options = [
		self::KEY_LANG_DEFAULT,
		self::KEY_FORMAT_TIME,
		self::KEY_FORMAT_DATE,
		self::KEY_FORMAT_DATETIME,
	]
	) {
		$data = [];
		foreach ($options as $index => $option) {
			if ($option == self::KEY_LOGO) {
				$data[] = [
					'key'        => $option,
					'value'      => CFile::upload(self::KEY_LOGO, $this->getTable()),
					'is_active'  => CConstant::STATE_ACTIVE,
					'autoload'   => CConstant::STATE_ACTIVE,
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now()
				];
			}
			else {
				$data[] = [
					'key'        => $option,
					'value'      => $this->{$option},
					'is_active'  => CConstant::STATE_ACTIVE,
					'autoload'   => CConstant::STATE_ACTIVE,
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now()
				];
			}
		}
		Cache::delete(config('common.cache.keys.settings'));

		return Setting::insertOnDuplicateKey($data, ['value', 'updated_at']);
	}

	/**
	 * @param $keys
	 * @param $data
	 * @return $this
	 */
	public function fillKeyValues($keys, $data) {
		foreach ($data as $key => $value) {
			if (in_array($key, $keys)) {
				$this->prepareKeyValue($key, $value);
			}
		}

		return $this;
	}

	public $keyFillable = [];

	/**
	 * @param mixed ...$keys
	 * @return Setting
	 */
	public function setKeyFillable(...$keys) {
		$this->keyFillable = $keys;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getKeyFillable(): array {
		return $this->keyFillable;
	}


	/**
	 * @param $data
	 * @return $this
	 */
	public function prepareValue($data) {
		foreach ($data as $key => $value) {
			if (in_array($key, $this->keyFillable)) {
				$this->prepareKeyValue($key, $value);
			}
		}

		return $this;
	}

	/**
	 * @param array $keyValues
	 * @param array $options
	 * @return Setting
	 */
	public function prepareKeyValues($keyValues, $options = []) {
		foreach ($keyValues as $key => $value) {
			$this->prepareKeyValue($key, $value, $options);
		}

		return $this;
	}

	/**
	 * @param string             $key
	 * @param string|int|boolean $value
	 * @param array              $options
	 * @return Setting
	 */
	public function prepareKeyValue($key, $value, $options = []) {

		$this->keyValues[] = [
			'key'        => $key,
			'value'      => $value,
			'is_active'  => isset($options['is_active']) ? $options['is_active'] : CConstant::STATE_ACTIVE,
			'autoload'   => isset($options['autoload']) ? $options['autoload'] : 0,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		];

		return $this;
	}

	/**
	 * @param array $keys
	 * @param array $options
	 * @return $this
	 */
	public function prepareKeyValueUploads($keys, $options = []) {
		foreach ($keys as $key) {
			$this->prepareKeyValueUpload($key, $options);
		}

		return $this;
	}

	/**
	 * @param string $key
	 * @param array  $options
	 * @return $this
	 */
	public function prepareKeyValueUpload($key, $options = []) {
		$old_file          = $this->loadModelByKey($key)->getAttribute($key);
		$this->keyValues[] = [
			'key'        => $key,
			'value'      => CFile::upload($key, $this->getTable(), $old_file),
			'is_active'  => isset($options['is_active']) ? $options['is_active'] : CConstant::STATE_ACTIVE,
			'autoload'   => isset($options['autoload']) ? $options['autoload'] : 0,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		];

		return $this;
	}

	protected $keyValues = [];

	/**
	 * @return int
	 * @throws \Psr\SimpleCache\InvalidArgumentException
	 */
	public function saveModel() {
		Cache::delete(config('common.cache.keys.settings'));

		return self::insertOnDuplicateKey($this->keyValues, ['value', 'updated_at', 'autoload', 'is_active']);
	}

	/**
	 * @return array
	 */
	public function getKeyValues(): array {
		return $this->keyValues;
	}

	/**
	 * @param array $keyValues
	 */
	public function setKeyValues(array $keyValues): void {
		$this->keyValues = $keyValues;
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getLanguage() {
		if (env("APP_NAME") == null) {
			return config('app.locale');
		}

		if (env("APP_KEY") == null) {
			return config('app.locale');
		}

		$locale = get_locale();
		if (!empty($locale)) {
			return $locale;
		}

		$locale = $this->getValue(self::KEY_LANG_DEFAULT);
		if (!empty($locale)) {
            return $locale;
        }

		return  config('app.locale');
	}
}

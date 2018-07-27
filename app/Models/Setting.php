<?php

namespace App\Models;

use App\Commons\CConstant;
use App\Commons\Facade\CFile;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\VarDumper\Dumper\esc;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Class Setting
 * @package  App\Models
 * @property string $website_name
 * @property string $website_description
 * @property string $admin_email
 * @property string $lang_default
 * @property string $format_time
 * @property string $format_date
 * @property string $format_datetime
 * @property string $blog_charset
 * @property string _message_order
 * @property string _message_order_success
 * @property string _message_order_fail
 * @property mixed  value
 * @property mixed  key
 */
class Setting extends Model
{
	use ModelTrait;
	use ModelUploadTrait;
	use InsertOnDuplicateKey;
	const KEY_WEBSITE_NAME          = 'website_name';
	const KEY_WEBSITE_DESCRIPTION   = 'website_description';
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
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function loadModel() {
		if (Session::has('settings')) {
			return Session::get('settings');
		}

		$models = Setting::where('autoload', 1)->get();
		$models->map(function($item, $index) {
			/**@var Setting $item */
			$key   = $item->getAttribute('key');
			$value = $item->getAttribute('value');

			$this->setAttribute($key, $value);
			$this->{$key} = $value;
		});

		Session::put('settings', $this);

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
				$this->setAttribute($model->key, $model->value);
				$this->{$model->key} = $model->value;
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
		if (Session::has('settings')) {
			/** @var Setting $models */
			$models    = Session::get('settings');
			$attribute = key_exists($key, $models);
			if (isset($attribute) && !empty($attribute)) {
				return $models->{$key};
			}
			else {
				throw  new  \Exception("$key " . __('admin/common.not found'));
			}
		}
		else {
			$this->loadModel();
			$attribute = key_exists($key, $this);
			if (isset($attribute) && !empty($attribute)) {
				return $this->{$key};
			}
			throw  new  \Exception("$key " . __('admin/common.not found'));
		}
	}

	/**
	 * @return mixed
	 */
	public static function getModel() {
		if (!Session::has('settings')) {
			return (new static)->loadModel();
		}

		return Session::get('settings');
	}

	/**
	 * @param Request $request
	 */
	public function setModel(Request $request) {
		$this->lang_default        = $request->get(self::KEY_LANG_DEFAULT);
		$this->format_date         = $request->get(self::KEY_FORMAT_DATE);
		$this->format_time         = $request->get(self::KEY_FORMAT_TIME);
		$this->format_datetime     = $request->get(self::KEY_FORMAT_DATETIME);
	}

	/**
	 * @param array $options
	 * @return bool|void
	 */
	public function save(
		array $options = [
			self::KEY_WEBSITE_NAME,
			self::KEY_WEBSITE_DESCRIPTION,
			self::KEY_LANG_DEFAULT,
			self::KEY_FORMAT_TIME,
			self::KEY_FORMAT_DATE,
			self::KEY_FORMAT_DATETIME,
			self::KEY_LOGO
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
		Session::remove('settings');
		Setting::insertOnDuplicateKey($data, ['value', 'updated_at']);
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
		$old_file = $this->loadModelByKey($key)->getAttribute($key);
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
	 */
	public function saveModel() {
		return self::insertOnDuplicateKey($this->keyValues, ['value', 'updated_at']);
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
}

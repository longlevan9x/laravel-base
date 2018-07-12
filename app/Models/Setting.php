<?php

namespace App\Models;

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
 */
class Setting extends Model
{
	use InsertOnDuplicateKey;
	const KEY_WEBSITE_NAME        = 'website_name';
	const KEY_WEBSITE_DESCRIPTION = 'website_description';
	const KEY_ADMIN_EMAIL         = 'admin_email';
	const KEY_LANG_DEFAULT        = 'lang_default';
	const KEY_FORMAT_TIME         = 'format_time';
	const KEY_FORMAT_DATE         = 'format_date';
	const KEY_FORMAT_DATETIME     = 'format_datetime';
	const KEY_BLOG_CHARSET        = 'blog_charset';

	/**
	 * @var array
	 */
	protected $fillable = ['key', 'value', 'is_active'];

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
		if (Session::has('setting')) {
			return Session::get('setting');
		}

		$models = Setting::all();
		$models->map(function($item, $index) {
			/**@var Setting $item */
			$key   = $item->getAttribute('key');
			$value = $item->getAttribute('value');

			$this->{$key} = $value;
		});

		Session::put('setting', $this);

		return $models;
	}

	/**
	 * @param $key
	 * @return mixed
	 * @throws \Exception
	 */
	public function getValue($key) {
		if (Session::has('setting')) {
			/** @var Setting $models */
			$models    = Session::get('setting');
			$attribute = key_exists($key, $models);
			if (isset($attribute) && !empty($attribute)) {
				return $models->{$key};
			} else {
				throw  new  \Exception("$key " . __('admin/common.not found'));
			}
		} else {
			$this->loadModel();
			$attribute = key_exists($key, $this);
			if (isset($attribute) && !empty($attribute)) {
				return $this->{$key};
			}
			throw  new  \Exception("$key " . __('admin/common.not found'));
		}
	}

	public static function getModel() {
		if (!Session::has('setting')) {
			(new static)->loadModel();
		}

		return Session::get('setting');
	}

	public function setModel(Request $request) {
		$this->website_name        = $request->get(self::KEY_WEBSITE_NAME);
		$this->website_description = $request->get(self::KEY_WEBSITE_DESCRIPTION);
		$this->lang_default        = $request->get(self::KEY_LANG_DEFAULT);
		$this->format_date         = $request->get(self::KEY_FORMAT_DATE);
		$this->format_time         = $request->get(self::KEY_FORMAT_TIME);
		$this->format_datetime     = $request->get(self::KEY_FORMAT_DATETIME);
	}

	public function save(
		array $options = [
			self::KEY_WEBSITE_NAME,
			self::KEY_WEBSITE_DESCRIPTION,
			self::KEY_LANG_DEFAULT,
			self::KEY_FORMAT_TIME,
			self::KEY_FORMAT_DATE,
			self::KEY_FORMAT_DATETIME
		]
	) {
		$data = [];
		foreach ($options as $index => $option) {
			$data[] = [
				'key'        => $option,
				'value'      => $this->{$option},
				'is_active'  => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			];
		}

		Setting::insertOnDuplicateKey($data, ['value', 'updated_at']);
	}
}

<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 09/16/2018
 * Time: 17:31
 */

namespace App\Models\Traits;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Trait ModelMetaTrait
 * @package App\Models
 * @method  static Builder where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 */
trait ModelMetaTrait
{
	use ModelUploadTrait;
	use InsertOnDuplicateKey;
	/**
	 * @return ModelMetaTrait
	 */
	public static function getInstance() {
		return (new static);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post() {
		return $this->belongsTo(static::class, $this->fieldForeignKey(), 'id');
	}

	/**
	 * @param        $foreign_key
	 * @param string $key
	 * @param string $value
	 * @return int
	 */
	public static function updateKeyValue($foreign_key, $key, $value) {
		$data = [
			static::getInstance()->fieldForeignKey() => $foreign_key,
			'key'                                    => $key,
			'value'                                  => $value,
			'created_at'                             => time(),
			'updated_at'                             => time()
		];

		return DB::table(self::table())->update($data);
	}

	/**
	 * @param $foreign_key
	 * @param $key
	 * @param $value
	 * @return Builder|Model
	 */
	public static function updateOrCreateKeyValue($foreign_key, $key, $value) {
		$data = [
			static::getInstance()->fieldForeignKey() => $foreign_key,
			'key'                                    => $key,
			'value'                                  => $value,
			'created_at'                             => time(),
			'updated_at'                             => time()
		];

		return self::updateOrCreate(['key' => $key], $data);
	}

	/**
	 * @param $foreign_key
	 * @param $key
	 * @param $value
	 * @return mixed
	 */
	public static function createKeyValue($foreign_key, $key, $value) {
		$data = [
			static::getInstance()->fieldForeignKey() => $foreign_key,
			'key'                                    => $key,
			'value'                                  => $value,
			'created_at'                             => time(),
			'updated_at'                             => time()
		];

		return DB::table(self::table())->insert($data);
	}

	/**
	 * @param string $key
	 * @return Model|null|object|static
	 */
	public static function getValue($key) {
		/** @var static $model */
		$model = self::where('key', $key)->first();
		$model->setAttributeKeyValue();

		return $model;
	}

	public function getValues($foreign_key) {
		/** @var static $model */
		$models = self::where($this->fieldForeignKey(), $foreign_key)->get();
		$model  = new self;
		if (isset($models) && !empty($models)) {
			$model = $models[0];
			foreach ($models as $index => $item) {
				/** @var static $item */
				$model->setAttribute($item->key, $item->value);
			}
		}

		return $model;
	}

	/**
	 * @return $this
	 */
	public function setAttributeKeyValue() {
		$this->setAttribute($this->key, $this->value);

		return $this;
	}
}
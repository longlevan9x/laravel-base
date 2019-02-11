<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 11/30/2018
 * Time: 22:07
 */

namespace App\Repositories;


use App\Models\Traits\ModelTrait;
use Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CacheRepository
 * @package App\Repositories
 */
class CacheRepository
{
	/**
	 * @var int
	 */
	protected $life_time = 0;

	/**
	 * CacheRepository constructor.
	 * @param int $life_time
	 * life_time = false. case not using Cache
	 */
	public function __construct($life_time = 0) {
		if ($life_time == 0) {
			$life_time = config('common.cache.life_time');
		}

		if ($life_time === false) {
			$life_time = 0;
		}
		$this->life_time = $life_time;
	}

	/**
	 * @param int $life_time
	 * @return static
	 */
	public static function getInstance($life_time = 0) {
		return new static($life_time);
	}

	/**
	 * @return int
	 */
	public function getLifeTime(): int {
		return $this->life_time;
	}

	/**
	 * @param int $life_time
	 * @return CacheRepository
	 */
	public function setLifeTime(int $life_time) {
		$this->life_time = $life_time;

		return $this;
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 4/27/2018
 * Time: 11:05 AM
 */

namespace App\Crawler;


use Goutte\Client;


/**
 * Class Crawler
 * @package App\Crawler
 * @property \Symfony\Component\DomCrawler\Crawler $crawler
 */
abstract class Crawler {
	/**
	 * @var string
	 */
	public static $base_url = 'http://daotaotn.uneti.edu.vn/';
	/**
	 * @var string
	 */
	public $url = '';
	/**
	 * @var int|string
	 */
	public $msv = "";
	/**
	 * @var string
	 */
	public $method = 'GET';
	/**
	 * @var Client|null
	 */
	protected $gouteClient = null;
	/**
	 * @var null
	 */
	protected $crawler = null;
	/**
	 * @var array
	 */
	protected $dotList = array();
	/**
	 * @var bool
	 */
	protected $get_with_key = true;

	/**
	 * Crawler constructor.
	 *
	 * @param bool $checkMsv
	 * @param int $msv
	 * @param string $method
	 *
	 * @throws \Exception
	 */
	public function __construct( $checkMsv = false, $msv = 0, $method = 'GET' ) {

		if ( $checkMsv && ! $msv ) {
			throw new \Exception( "MSV trống!" );
		}
		$this->msv         = $msv;
		$this->method      = $method;
		$this->gouteClient = new Client();
	}

	/**
	 * @var array
	 */
	protected $list = [];

	/**
	 * @return mixed
	 */
	abstract protected function prepare();

	/**
	 * @return array
	 */
	public function asArray() {
		$this->prepare();

		return $this->list;
	}

	/**
	 * @return string
	 */
	public function asHtml() {
		return $this->crawler->html();
	}

	/**
	 * @return string
	 */
	public function asJson() {
		$this->prepare();

		return json_encode( $this->list, JSON_NUMERIC_CHECK );
	}

	/**
	 * @param array $dotList
	 *
	 * @return Crawler
	 */
	public function setDotList( $dotList ) {
		$this->dotList = $dotList;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getDotList() {
		return $this->dotList;
	}

	/**
	 * @return string
	 */
	abstract public function getUrl();

	/**
	 * @param string $url
	 *
	 * @return Crawler
	 */
	abstract public function setUrl( $url );

	/**
	 * lay du lieu ve gom ca key value
	 * @return bool
	 */
	public function isGetWithKey() {
		return $this->get_with_key;
	}

	/**
	 * @param bool $get_with_key
	 *
	 * @return Crawler
	 */
	public function setGetWithKey( $get_with_key = false ) {
		$this->get_with_key = $get_with_key;

		return $this;
	}

	/**
	 * @return \Symfony\Component\DomCrawler\Crawler
	 */
	protected function setRequest() {
		return $this->crawler = $this->gouteClient->request( $this->method, $this->getUrl() . $this->msv );
	}
}
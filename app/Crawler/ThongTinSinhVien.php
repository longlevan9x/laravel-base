<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 4/27/2018
 * Time: 9:15 PM
 */

namespace App\Crawler;


use function foo\func;

class ThongTinSinhVien extends Crawler
{
	public static $xem_dem_url = '';

	/**
	 * ThongTinSinhVien constructor.
	 * @param bool   $checkMsv
	 * @param int    $msv
	 * @param string $method
	 * @throws \Exception
	 */
	public function __construct($checkMsv = false, $msv = 0, $method = 'GET') {
		parent::__construct($checkMsv, $msv, $method);
		$this->crawler = $this->setRequest(); // lay form ve
	}

	protected function prepare() {
		if($this->crawler->count() == 0) {
			return $this->list = [];
		}
		if( ! $this->checkTrangThai()) {
			return $this->list = [];
		}

		// TODO: Implement prepare() method.
		$this->crawler->filter('.body-group')->filter('table')->filter('tr')->each(function($node) {
			$name = trim($this->crawler->filter('.title-group')->text());
			$name = str_replace('BẢNG KẾT QUẢ HỌC TẬP', '', $name);
			$name = trim($name);
			/** @var \Symfony\Component\DomCrawler\Crawler $node */
			if($this->get_with_key) {
				$this->list['name'] = $name;
				$arr                = explode(":", trim($node->filter('td')->text())); // chuyen chuoi ve mang theo dau ':'
				if($arr[0] == 'Khóa') {
					$arr[0] = 'khoa_hoc';
				}
				$this->list[vn2latin(trim($arr[0]), '_')] = isset($arr[1]) ? trim($arr[1]) : '';
				$arr                                      = explode(":", trim($node->filter('td:last-child')->text()));
				$this->list[vn2latin(trim($arr[0]), '_')] = isset($arr[1]) ? trim($arr[1]) : '';
			} else {
				$this->list[] = $name;
				$this->list[] = trim($node->filter('td')->text());
				$this->list[] = trim($node->filter('td:last-child')->text());
			}
		});

		$tong_so_tc_tich_luy = $this->crawler->filter('#ctl00_ContentPlaceHolder_ucThongTinTotNghiepTinChi1_lblTongTinChi')->text();
		$diem_tb_tich_luy = $this->crawler->filter('#ctl00_ContentPlaceHolder_ucThongTinTotNghiepTinChi1_lblTBCTL')->text();

		if($this->get_with_key) {
			$this->list['tong_so_tc_tich_luy'] = $tong_so_tc_tich_luy;
			$this->list['diem_tb_tich_luy']    = $diem_tb_tich_luy;
		} else {

		}
	}

	/**
	 * @return $this
	 */
	public function getThongTinSinhVien() {
		$this->setRequest();
		$this->crawler = $this->crawler->filter('.main-content');

		return $this;
	}

	public function checkTrangThai() {
		$text = $this->crawler->filter('.main-content')->filter('.body-group')->filter('table')->text();
		if(strpos($text, 'Bảo lưu') > 0 || strpos($text, 'Đình chỉ') > 0 || strpos($text, 'Thôi học') > 0 || strpos($text, 'Đã tốt nghiệp') > 0) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return self::$base_url . 'XemDiem.aspx?MSSV=';
	}

	/**
	 * @param string $url
	 * @return Crawler
	 */
	public function setUrl($url) {
		$this->url = $url;

		return $this;
	}
}
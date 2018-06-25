<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 4/27/2018
 * Time: 11:03 AM
 */

namespace App\Crawler;


use App\Helpers\Facade\Helper;
use Exception;

class LichThi extends Crawler
{
	private $tenDotThi = '';
	private const XEM_LICH_THI_BUTTON = "Xem lịch thi";

	/**
	 * LichThi constructor.
	 * @param bool   $checkMsv
	 * @param int    $msv
	 * @param string $method
	 * @throws Exception
	 */
	public function __construct($checkMsv = false, $msv = 0, $method = 'GET') {
		parent::__construct($checkMsv, $msv, $method);
		$this->crawler = $this->setRequest(); // lay form ve
		$this->getDotThi(); //lay list array dot thi ve
	}

	/**
	 * @param $tenDotThi
	 * @return bool|string
	 */
	public function getLichThiHtml($tenDotThi) {

		$formXemLichThi = $this->crawler->selectButton(self::XEM_LICH_THI_BUTTON)->form();

		$dotThiId = array_search(trim($tenDotThi), $this->dotList);
		//        echo ( $dotThiId );
		//        die();
		$crawler = $this->gouteClient->submit($formXemLichThi, array(
			"ctl00\$ContentPlaceHolder\$cboHocKy3" => $dotThiId, // dot thi id
			"ctl00\$ContentPlaceHolder\$TestType"  => "radAllTest",
			"ctl00\$ContentPlaceHolder\$btnSearch" => "Xem+lịch+thi",
			"ctl00\$ucRight1\$rdSinhVien"          => 1,
		));

		$html = false;
		try {
			$html = "<table>" . $crawler->filter("#detailTbl")->html() . "</table>";
		} catch(Exception $ex) {
			echo $ex->getMessage() . "<br/>";
			echo $ex->getTraceAsString();
			$html = false;

		}

		return $html;
	}

	/**
	 * LẤy về danh sách đợt thi, dạng id key , value là giá trị text của đợt đó
	 */
	public function getDotThi() {
		$this->crawler->filter("#ctl00_ContentPlaceHolder_cboHocKy3 > option")->each(function($node) {
			/** @var \Symfony\Component\DomCrawler\Crawler $node */
			if(intval($node->attr("value")) != -1) { // ko lấy cái đầu tiên
				$this->dotList[$node->attr("value")] = trim($node->text());
			}
		});

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTenDotThi() {
		return $this->tenDotThi;
	}

	/**
	 * @param string $tenDotThi
	 * @return LichThi
	 */
	public function setTenDotThi($tenDotThi) {
		$this->tenDotThi = $tenDotThi;

		return $this;
	}


	private $data            = [];
	private $data1           = [];
	private $code_class      = 0;
	private $code_class_prev = 0;

	protected function prepare() {
		$this->list     = [];
		$formXemLichThi = $this->crawler->selectButton(self::XEM_LICH_THI_BUTTON)->form();

		$dotThiId = array_search(trim($this->tenDotThi), $this->dotList);
		//        echo ( $dotThiId );
		//        die();
		$this->crawler = $this->gouteClient->submit($formXemLichThi, array(
			"ctl00\$ContentPlaceHolder\$cboHocKy3" => $dotThiId, // dot thi id
			"ctl00\$ContentPlaceHolder\$TestType"  => "radAllTest",
			"ctl00\$ContentPlaceHolder\$btnSearch" => "Xem+lịch+thi",
			"ctl00\$ucRight1\$rdSinhVien"          => 1,
		));

		try {
			// TODO: Implement prepare() method.
			$this->data = [];
			/**
			 * @var \Symfony\Component\DomCrawler\Crawler $node
			 * lay het ra cac hang trong node  cua class table-lich-hoc
			 */

			$this->crawler->filter('#detailTbl')->filter('tr')->each(function($note_tr) {
				/**
				 * @var \Symfony\Component\DomCrawler\Crawler $note_tr
				 */
				if($note_tr->filter("th")->count() == 0) {
					/**
					 * @var \Symfony\Component\DomCrawler\Crawler $note_tr
					 */
					/**lay ve ma mon hoc */
					$this->code_class = trim($note_tr->filter('td:nth-of-type(2)')->text());

					// truong hop trong 1 buoi (sang hoac chieu) hoc 2  mon thi phai check de lay cat no ra lam 2
					if($this->code_class_prev != 0 && $this->code_class != $this->code_class_prev) {
						if( ! empty($this->data)) {
							$this->list[replace_multiple_space($this->code_class_prev, '')] = $this->prepareData();
						}
						$this->data = [];
					}

					if($this->get_with_key) {
						$this->data[] = [
							'code'        => replace_multiple_space(trim($note_tr->filter('td:nth-of-type(2)')->text()), ''),
							'name'        => replace_multiple_space(trim($note_tr->filter('td:nth-of-type(3)')->text())),
							'group'       => trim($note_tr->filter('td:nth-of-type(4)')->text()),
							'serial'      => trim($note_tr->filter('td:nth-of-type(5)')->text()),
							'test_day'    => replace_multiple_space(trim($note_tr->filter('td:nth-of-type(6)')->text())),
							'semester'    => trim($this->tenDotThi),
							'examination' => replace_multiple_space(trim($note_tr->filter('td:nth-of-type(7)')->text())),
							'room'        => trim($note_tr->filter('td:nth-of-type(8)')->text()),
							'type'        => trim($note_tr->filter('td:nth-of-type(9)')->text()),
							'note'        => trim($note_tr->filter('td:nth-of-type(10)')->text()),
							'is_active'   => 1,
							'created_at'  => date("Y-m-d H:i:s"),
							'updated_at'  => date("Y-m-d H:i:s"),
						];
					} else {
						/*
						 *  lay ra het cac cot
						 */
						$this->data1 = [];
						$note_tr->filter('td')->each(function($node_td) {
							/**
							 * @var \Symfony\Component\DomCrawler\Crawler $node_td
							 * lay het cac   cot dua vao 1 mang
							 */
							$this->data1[] = replace_multiple_space(trim($node_td->text()));
						});
						/**
						 * dua cac dong vao 1 mang
						 */
						$this->data[] = $this->data1;
					}
					$this->code_class_prev = trim($note_tr->filter('td:nth-of-type(2)')->text());
				}
			});

			/**
			 * dua lich hoc theo ma mon hoc vao 1 mang
			 */
			if( ! empty($this->data)) {
				$this->list[replace_multiple_space($this->code_class, '')] = $this->prepareData();
			}

		} catch(Exception $ex) {
			echo $ex->getMessage() . "<br/>";
			echo $ex->getTraceAsString();
		}
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return self::$base_url . 'XemLichThi.aspx?MSSV=';
	}

	/**
	 * @param string $url
	 * @return Crawler
	 */
	public function setUrl($url) {
		$this->url = $url;

		return $this;
	}

	/**
	 * @param $tenDotThi
	 * @return $this
	 */
	public function getLichThi($tenDotThi) {
		$this->tenDotThi = $tenDotThi;
		$this->setRequest();
		$this->crawler = $this->crawler->filter('.main-content');

		return $this;
	}

	private function prepareData() {
		if(empty($this->data)) {
			return [];
		}
		// trong mảng data sẽ có nhiều dữ liệu của 1 môn học
		$arrFirst = $this->data[0]; // lay ra phan tu dau tien của mảng

		return $arrFirst;
	}

	/**
	 * @param $code_class
	 * @return int
	 */
	private function prepareCodeClass($code_class) {
		$code_class = replace_multiple_space($code_class);
		$arr        = explode('-', $code_class);

		return isset($arr[0]) ? trim($arr[0]) : 0;
	}
}
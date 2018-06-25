<?php
/*
 * created by Long
 */

use Goutte\Client;

class LichHocCrawler{
    private static $XEM_LICH_THI_URL = "http://daotaotn.uneti.edu.vn/XemLichHoc.aspx?MSSV=";
    private static $XEM_LICH_THI_BUTTON = "Xem lịch học";
    private $msv = "";
    private $gouteClient = null;
    private $crawler = null;
    private $dotList = array();

    /**
     * LichHocCrawler constructor.
     * @param bool $msv
     */
    public function __construct($msv = false) {
        if (!$msv) {
            throw Exception("MSV trống!");
        }
        $this->msv = $msv;
        $this->gouteClient = new Client();
        $this->crawler = $this->gouteClient->request("GET", $this::$XEM_LICH_THI_URL . $this->msv); // lay form ve 
        $this->getDot(); //lay list array dot thi ve
    }

    /**
     * lay ve lich hoc mac dinh ko can submit
     * @return string
     */
    public function getLichHocHtml() {
        return $this->crawler->filter('#detailTbl')->html();
    }

    /**
     * lay lich hoc theo dot va can submit button
     * @param $tenDot
     * @return bool|string
     */
    public function getLichHocHtmlSubmitButton($tenDot) {

        $formXemLichHoc = $this->crawler->selectButton($this::$XEM_LICH_THI_BUTTON)->form();

        $dotId = array_search( trim($tenDot), $this->dotList );
//        echo ( $dotId );
//        die();
        $crawler = $this->gouteClient->submit($formXemLichHoc, array(
            "ctl00\$ContentPlaceHolder\$cboHocKy3" => $dotId , // dot id
            "ctl00\$ContentPlaceHolder\$TestType" => "radAllTest",
            "ctl00\$ContentPlaceHolder\$btnSearch" => "Xem+lịch+học",
            "ctl00\$ucRight1\$rdSinhVien" => 1,
        ));

        $html = false;
        try {
            $html = "<table>" .
                $crawler->filter("#detailTbl")->html() .
                "</table>";
        } catch (Exception $ex) {
            echo $ex->getMessage() . "<br/>";
            echo $ex->getTraceAsString();
            $html = false;

        }
        return $html;
    }

    /**
     * LẤy về danh sách đợt , dạng id key , value là giá trị text của đợt đó
     */
    public function getDot() {
        $this->crawler->filter("#ctl00_ContentPlaceHolder_cboHocKy3 > option")->each(function( $node ) {
            /** @var \Symfony\Component\DomCrawler\Crawler $node */
            if (intval($node->attr("value")) != -1) { // ko lấy cái đầu tiên
                $this->dotList[$node->attr("value")] = trim($node->text());
            }
        });
    }
}
<?php

/*
 * A project of CuongDCDev@gmail.com
 */

use Goutte\Client;

class LichThiCrawler {

    private static $XEM_LICH_THI_URL = "http://daotaotn.uneti.edu.vn/XemLichThi.aspx?MSSV=";
    private static $XEM_LICH_THI_BUTTON = "Xem lịch thi";
    private $msv = "";
    private $gouteClient = null;
    private $crawler = null;
    private $dotThiList = array();

    public function __construct($msv = false) {
        if (!$msv) {
            throw Exception("MSV trống!");
        }
        $this->msv = $msv;
        $this->gouteClient = new Client();
        $this->crawler = $this->gouteClient->request("GET", $this::$XEM_LICH_THI_URL . $this->msv); // lay form ve 
        $this->getDotThi(); //lay list array dot thi ve 
    }

    public function getLichThiHtml($tenDotThi) {
        
        $formXemLichThi = $this->crawler->selectButton($this::$XEM_LICH_THI_BUTTON)->form();
        
        $dotThiId = array_search( trim($tenDotThi), $this->dotThiList );
//        echo ( $dotThiId ); 
//        die();
        $crawler = $this->gouteClient->submit($formXemLichThi, array(
            "ctl00\$ContentPlaceHolder\$cboHocKy3" => $dotThiId , // dot thi id 
            "ctl00\$ContentPlaceHolder\$TestType" => "radAllTest",
            "ctl00\$ContentPlaceHolder\$btnSearch" => "Xem+lịch+thi",
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
     * LẤy về danh sách đợt thi, dạng id key , value là giá trị text của đợt đó 
     */
    public function getDotThi() {
        $this->crawler->filter("#ctl00_ContentPlaceHolder_cboHocKy3 > option")->each(function( $node ) {
            if (intval($node->attr("value")) != -1) { // ko lấy cái đầu tiên 
                $this->dotThiList[$node->attr("value")] = trim($node->text());
            }
        });
    }

}

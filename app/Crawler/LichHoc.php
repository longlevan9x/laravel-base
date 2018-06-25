<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 4/27/2018
 * Time: 10:54 AM
 */

namespace App\Crawler;


use App\Helpers\Facade\Helper;
use Exception;

class LichHoc extends Crawler
{
    private static $XEM_LICH_THI_BUTTON = "Xem lịch học";

    /**
     * LichHoc constructor.
     * @param bool $checkMsv
     * @param int $msv
     * @param string $method
     * @throws Exception
     */
    public function __construct($checkMsv = false, $msv = 0, $method = 'GET')
    {
        parent::__construct($checkMsv, $msv, $method);
        $this->crawler = $this->setRequest(); // lay form ve
        $this->getDot(); //lay list array dot thi ve
    }

    /**
     * lay ve lich hoc mac dinh ko can submit
     * @return string
     */
    public function getLichHocHtml()
    {
        return $this->getLichHoc()->asHtml();
    }

    /**
     * lay lich hoc theo dot va can submit button
     * @param $tenDot
     * @return bool|string
     */
    public function getLichHocHtmlSubmitButton($tenDot)
    {

        $formXemLichHoc = $this->crawler->selectButton(self::$XEM_LICH_THI_BUTTON)->form();

        $dotId = array_search(trim($tenDot), $this->dotList);
//        echo ( $dotId );
//        die();
        $crawler = $this->gouteClient->submit($formXemLichHoc, array(
            "ctl00\$ContentPlaceHolder\$cboHocKy3" => $dotId, // dot id
            "ctl00\$ContentPlaceHolder\$TestType"  => "radAllTest",
            "ctl00\$ContentPlaceHolder\$btnSearch" => "Xem+lịch+học",
            "ctl00\$ucRight1\$rdSinhVien"          => 1,
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
    public function getDot()
    {
        $this->crawler->filter("#ctl00_ContentPlaceHolder_cboHocKy3 > option")->each(function ($node) {
            /** @var \Symfony\Component\DomCrawler\Crawler $node */
            if (intval($node->attr("value")) != -1) { // ko lấy cái đầu tiên
                $this->dotList[$node->attr("value")] = trim($node->text());
            }
        });
        return $this;
    }

    /**
     * @return $this
     */
    public function getLichHoc()
    {
        $this->setRequest();
        $this->crawler = $this->crawler->filter('.main-content');
        return $this;
    }

    private $data = [];
    private $data1 = [];
    private $code_class = 0;
    private $code_class_prev = 0;

    protected function prepare()
    {
        $this->list = [];
        // TODO: Implement prepare() method.
        // duyet qua het cac node cua class table-lich-hoc
        $this->crawler->filter('#detailTbl')->filter('.table-lich_hoc')->each(function ($node) {
            $this->data = [];
            /**
             * @var \Symfony\Component\DomCrawler\Crawler $node
             * lay het ra cac hang trong node  cua class table-lich-hoc
             */
            $node->filter('tr')->each(function ($note_tr) {
                /**
                 * @var \Symfony\Component\DomCrawler\Crawler $note_tr
                 */
                /**lay ve ma mon hoc */
                $this->code_class = trim($note_tr->filter('td:first-child')->text());

                // truong hop trong 1 buoi (sang hoac chieu) hoc 2  mon thi phai check de lay cat no ra lam 2
                if ($this->code_class_prev != 0 && $this->code_class != $this->code_class_prev) {
                    if (!empty($this->data)) {
                        $this->list[$this->code_class_prev] = $this->prepareData();
                    }
                    $this->data = [];
                }

                if ($this->get_with_key) {
                    $time = trim($note_tr->filter('td:nth-of-type(6)')->text());
                    $time = replace_multiple_space($time); // clear multiple space to a space
                    $arrTime = explode(' ', $time);
                    $this->data[] = [
                        'code'       => trim($note_tr->filter('td:first-child')->text()),
                        'name'       => str_replace("(Môn học đã kết thúc)", "", replace_multiple_space(trim($note_tr->filter('td:nth-of-type(2)')->text()))),
                        'semester'   => $this->getSemester(),
                        'lesson'     => trim($note_tr->filter('td:nth-of-type(3)')->text()),
                        'start_time' => isset($arrTime[0]) ? date("Y-m-d", strtotime(trim(substr($arrTime[0], strpos($arrTime[0], ':') + 1)))) : 0,
                        'end_time'   => isset($arrTime[1]) ? date("Y-m-d", strtotime(trim(substr($arrTime[1], strpos($arrTime[1], ':') + 1)))) : 0,
                        'teacher'    => trim($note_tr->filter('td:nth-of-type(4)')->text()),
                        'classroom'  => trim($note_tr->filter('td:nth-of-type(5)')->text()),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                } else {
                    /*
                     *  lay ra het cac cot
                     */
                    $this->data1 = [];
                    $note_tr->filter('td')->each(function ($node_td) {
                        /**
                         * @var \Symfony\Component\DomCrawler\Crawler $node_td
                         * lay het cac   cot dua vao 1 mang
                         */
                        $this->data1[] = trim($node_td->text());
                    });
                    /**
                     * dua cac dong vao 1 mang
                     */
                    $this->data[] = $this->data1;
                }
                $this->code_class_prev = trim($note_tr->filter('td:first-child')->text());
            });
            /**
             * dua lich hoc theo ma mon hoc vao 1 mang
             */
            $this->list[$this->code_class] = $this->prepareData();
        });
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return self::$base_url . 'XemLichHoc.aspx?MSSV=';
    }

    /**
     * @param string $url
     * @return Crawler
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return array|mixed
     */
    private function prepareData()
    {
        if (empty($this->data)) {
            return [];
        }

        // trong mảng data sẽ có nhiều dữ liệu của 1 môn học
        $arrFirst = $this->data[0]; // lay ra phan tu dau tien của mảng
        $arrEnd = end($this->data); // lay ra phần tử cuối cùng của mảng

        if ($this->get_with_key) {
            $arrFirst['end_time'] = $arrEnd['end_time'];
            $arrFirst['session'] = Helper::getCaHocTrongNgay($arrFirst['lesson']);
            $arrFirst['weekday'] = Helper::getWeekInDay($arrFirst['end_time']);
        } else {
            /*print data for debug*/
            //print_r($arrFirst);die;
            $time = $arrFirst[5];
            $time = replace_multiple_space($time); // clear multiple space to a space
            $arrTime = explode(' ', $time);
            $tu = isset($arrTime[0]) ? substr($arrTime[0], strpos($arrTime[0], ':') + 1) : 0;

            $time = $arrEnd[5];
            $time = replace_multiple_space($time); // clear multiple space to a space
            $arrTime = explode(' ', $time);

            $den = isset($arrTime[1]) ? substr($arrTime[1], strpos($arrTime[1], ':') + 1) : 0;

            $arrFirst[1] = replace_multiple_space($arrFirst[1]);
            $arrFirst[5] = $tu;
            $arrFirst[6] = $den;
            $arrFirst[] = Helper::getCaHocTrongNgay($arrFirst[2]);
            $arrFirst[] = Helper::getWeekInDay($arrFirst[5]);
        }
        return $arrFirst;
    }

    /**
     * @return string
     */
    private function getSemester()
    {
        return $this->crawler->filter('#mainTbl')->filter('#ctl00_ContentPlaceHolder_cboHocKy3')->filter('option:selected')->text();
    }
}
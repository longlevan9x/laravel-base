<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/9/2018
 * Time: 4:02 PM
 */

namespace App\Helpers;

/**
 * Class Common
 * @package App\Helper
 */
class Helper
{
    /**
     * tra ve so ky tư con thieu trong day so ma sinh vien.
     * Ex: $number = 1
     *  $msv = 141031
     *  method sẽ trả về là 0000 + 1 và noi voi msv
     * @param $msv
     * @param $number
     * @return string
     */
    public function getMsv($msv, $number) {
        return $msv . str_repeat(0, 5 - strlen($number)) . $number;
    }

    /**
     * @param $tiet_hoc
     * @return string
     */
    public function getCaHocTrongNgay($tiet_hoc) {
        $arrTietHoc = explode('->', $tiet_hoc);
        if (!empty($arrTietHoc)) {
            $first = (int)trim($arrTietHoc[0]);
            $end = (int)trim($arrTietHoc[1]);
            if ($first + $end < 13) {
                return 'Sáng';
            }
            elseif ($first + $end < 24) {
                return 'Chiều';
            }
            else {
                return' Tối';
            }
        }
        return "";
    }

    /**
     * @param string|int $day
     * @param string $format
     * format == w -> 0 (for Sunday) through 6 (for Saturday)
     * format == N -> 1 (for Monday) through 7 (for Sunday)
     * @return false|string
     */
    public function getWeekInDay($day, $format = "N") {
        if (is_int($day)) {
            return date($format, $day);
        }
        return date($format, strtotime($day));
    }

    /**
     * @param $day
     * @param string $format
     * @return mixed
     */
    public function getFullTextualWeekInDay($day, $format = 'w') {
        if (strlen($day) > 1) {
            $day = $this->getWeekInDay($day, $format);
        }

        $arrTextDay = ['Chủ nhật', 'Hai', 'Ba', "Tư", "Năm", "Sáu", "Bảy"];
        return $arrTextDay[$day];
    }
}
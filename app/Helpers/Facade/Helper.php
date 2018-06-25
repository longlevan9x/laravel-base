<?php
/**
 * Created by PhpStorm.
 * User: LongPC
 * Date: 5/9/2018
 * Time: 4:17 PM
 */

namespace App\Helpers\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Helper
 * @package App\Helper\Facade
 * @method static string getMsv(string $msv, string|int $number)
 * @method static string getCaHocTrongNgay(string $tiet_hoc)
 * @method static string|false getWeekInDay(string|int $day, string $format = "N")
 * @method static string|false getFullTextualWeekInDay(string|int $day, string $format = "w")
 * @see \App\Helpers\Helper
 */
class Helper extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'helper';
    }
}
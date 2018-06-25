<?php

namespace App\Http\Controllers\Api\v1;

use App\Crawler\LichHoc;
use App\Crawler\ThongTinSinhVien;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function getSchedule(Request $request) {

    }

    public function syncSchedule($msv) {
        $thong_tin = new ThongTinSinhVien(14103100197);
        echo '<pre>';
        print_r($thong_tin->getThongTinSinhVien()->asArray());
//        $lich_hoc = new LichHoc(14103100197);
//        echo $lich_hoc->getLichHoc()->asHtml();
    }
}

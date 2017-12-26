<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForeignTradeScreenController extends Controller
{
    const THISMONTH = '201711';
    public function index(){
        return "";
    }

    public function totals(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select month, money, count from foreigntotals ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function country(){
        // 抵运国家TOP5   单位 （万美元）
        $data = DB::select('select `month`, country, money, percent from foreigncountrys WHERE `month` = '.self::THISMONTH.' ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    public function area(){
        // 抵运区域分析   单位 （万美元）
        $data = DB::select('select `month`, area, money, percent from foreignareas WHERE `month` = '.self::THISMONTH.' ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    public function route(){
        // 一带一路出口分析   单位 （万美元）
        $data = DB::select('select `month`, route, money, percent from foreignroutes WHERE `month` = '.self::THISMONTH.' ORDER BY money DESC, id DESC LIMIT 6');
        return json_encode($data);
    }

    public function category(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select `month`, category, money, percent from foreigncategorys WHERE `month` = '.self::THISMONTH.' ORDER BY money DESC, id DESC LIMIT 7');
        return json_encode($data);
    }

    public function csindex(){
        // 男装常熟出口价格指数
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreigncsindexs ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function qgindex(){
        // 男装全国出口价格指数
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreignqgindexs ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }
}

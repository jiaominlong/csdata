<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForeignTradeScreenController extends Controller
{
    public function index(){
        return "";
    }

    public function totals(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select month, money, count from foreigntotals ORDER BY month DESC LIMIT 12');
        return json_encode($data);
    }

    public function country(){
        // 抵运国家TOP5   单位 （万美元）
        $data = DB::select('select country, money, percent from foreigncountrys ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    public function area(){
        // 抵运区域分析   单位 （万美元）
        $data = DB::select('select area, money, percent from foreignareas ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    public function route(){
        // 一带一路出口分析   单位 （万美元）
        $data = DB::select('select route, money, percent from foreignroutes ORDER BY money DESC, id DESC LIMIT 6');
        return json_encode($data);
    }

    public function category(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select category, money, percent from foreigncategorys ORDER BY money DESC, id DESC LIMIT 7');
        return json_encode($data);
    }

    public function csindex(){
        // 男装常熟出口价格指数
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreigncsindexs ORDER BY month DESC LIMIT 12');
        return json_encode($data);
    }

    public function qgindex(){
        // 男装全国出口价格指数
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreignqgindexs ORDER BY month DESC LIMIT 12');
        return json_encode($data);
    }
}

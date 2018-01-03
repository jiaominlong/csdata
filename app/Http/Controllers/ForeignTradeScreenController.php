<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForeignTradeScreenController extends Controller
{
    public function index(){
        return "";
    }

    /***********   出口金额、报关单趋势(万美元)  ************/
    public function totals(){
        $data = DB::select('select month, money, count from foreigntotals ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    /***********   全国男装出口价格指数  ************/
    public function qgindex(){
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreignqgindexs ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    /***********   常熟男装出口价格指数  ************/
    public function csindex(){
        // 男装常熟出口价格指数
        $data = DB::select('select month, dingji, huanbi, tongbi FROM foreigncsindexs ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    /***********   出口抵运国家TOP5（万美元） ************/
    public function country(){
        $thisyearmonth = DB::select('SELECT `month` FROM foreigncountrys ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('select `month`, country, money, percent from foreigncountrys WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    /***********   抵运区域分析   单位 （万美元）  ************/
    public function area(){
        $thisyearmonth = DB::select('SELECT `month` FROM foreignareas ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('select `month`, area, money, percent from foreignareas WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY money DESC LIMIT 5');
        return json_encode($data);
    }

    /***********   各类商品出口占比   单位 （万美元）  ************/
    public function category(){
        $thisyearmonth = DB::select('SELECT `month` FROM foreigncategorys ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('select `month`, category, money, percent from foreigncategorys WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY money DESC, id DESC LIMIT 7');
        return json_encode($data);
    }
    /***********   一带一路出口情况   单位 （万美元）  ************/
    public function route(){
        $thisyearmonth = DB::select('SELECT `month` FROM foreignroutes ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('select `month`, route, money, percent from foreignroutes WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY money DESC, id DESC LIMIT 6');
        return json_encode($data);
    }

}

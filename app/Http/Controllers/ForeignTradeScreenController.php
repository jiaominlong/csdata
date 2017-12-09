<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForeignTradeScreenController extends Controller
{
    public function index(){
        return "Hello, Wrold";
    }

    public function totals(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select * from foreigntotals');
        return json_encode($data);
    }

    public function country(){
        // 抵运国家TOP5   单位 （万美元）
        $data = DB::select('select * from foreigncountrys');
        return json_encode($data);
    }

    public function area(){
        // 抵运区域分析   单位 （万美元）
        $data = DB::select('select * from foreignareas');
        return json_encode($data);
    }

    public function route(){
        // 一带一路出口分析   单位 （万美元）
        $data = DB::select('select * from foreignroutes');
        return json_encode($data);
    }

    public function category(){
        // 品类出口分析   单位 （万美元）
        $data = DB::select('select * from foreigncategorys');
        return json_encode($data);
    }
}

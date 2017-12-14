<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexScreenController extends Controller
{
    //
    public function neixiaoprice(){
        // 男装内销价格指数
        $data = DB::select('SELECT month AS \'月份\', times AS \'旬数\', category AS \'类别\', zengsu AS \'增速\', huanbi AS \'环比\', dingji AS \'定基\', tongbi AS \'同比\' FROM indexnxprice ORDER BY month DESC, times DESC');
        return json_encode($data);
    }

    public function neixiaopricetotalindex(){
        // 男装内销价格总指数走势
        $data = DB::select('SELECT month AS \'月份\', dingji AS \'定基\', tongbi AS \'同比\', huanbi AS \'环比\' FROM indexnxpricetotaltrend ORDER BY month DESC');
        return json_encode($data);
    }

    public function neixiaobigcateindex(){
        // 男装内销价格总指数走势
        $data = DB::select('SELECT month AS \'月份\', category AS \'类别\', `index` AS \'指数\' FROM indexnxbigcatetrend');
        return json_encode($data);
    }

    public function manjingqiindex(){
        // 男装景气指数
        $data = DB::select('SELECT month AS \'月份\', category AS \'类别\', `index` AS \'指数\' FROM indexjingqiindex');
        return json_encode($data);
    }

    public function manjingqiindexindu(){
        // 男装行业景气指数
        $data = DB::select('SELECT `month` AS \'月份\', `index` AS \'指数\' FROM indexjingqiindu');
        return json_encode($data);
    }

    public function manjingqiindexcate(){
        // 男装类别景气指数
        $data = DB::select('SELECT `month` AS \'月份\', `category` AS \'类别\', `index` AS \'指数\' FROM indexjingqicate');
        return json_encode($data);
    }

    public function marketcatesale(){
        // 市场大类销售占比
        $data = DB::select('SELECT `month` AS \'月份\', `category` AS \'类别\', `index` AS \'销售额\' FROM marketcatesale ORDER BY created_at DESC');
        return json_encode($data);
    }

    public function onlinesale(){
        // 市场交易额区县
        $data = DB::select('SELECT `month` AS \'月份\', `sale` AS \'销售额\', `salecount` AS \'销量\' FROM indexonlinesale');
        return json_encode($data);
    }

    public function onlinecate(){
        // 淘宝天猫各大类销售占比
        $data = DB::select('SELECT `month` AS \'月份\', `category` AS \'类别\', `index` AS \'销售额\' FROM marketcatesale ORDER BY created_at DESC');
        return json_encode($data);
    }

    public function onlinesaledata(){
        // 淘宝天猫各销售数据
        $data = DB::select('SELECT `month` AS \'月份\', `category` AS \'类别\', `sale` AS \'销售额（量）\', `huanbi` AS \'环比\', `tongbi` AS \'同比\' FROM indexsaledata ORDER BY created_at DESC');
        return json_encode($data);
    }
}

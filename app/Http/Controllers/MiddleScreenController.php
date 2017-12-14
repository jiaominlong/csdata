<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiddleScreenController extends Controller
{
    public function total (){
        // 数据汇总
        $data = DB::select('SELECT month AS \'月份\', category AS \'类别\', unit AS \'单位\', `data` AS \'数值\' FROM middletotal ORDER BY `month` LIMIT 4');
        return json_encode($data);
    }

    public function marketcate (){
        // 市场交易类别占比
        $data = DB::select('SELECT month AS \'月份\', category AS \'类别\', unit AS \'单位\', `data` AS \'数值\' FROM middlemarketcate ORDER BY `month` LIMIT 4');
        return json_encode($data);
    }

    public function towndata (){
        // 乡镇热力图
        $data = DB::select('SELECT `month`,	SUM(`outputadd`) AS outputadd, SUM(`outputsame`) AS outputsame,	SUM(`taxadd`) AS taxadd, SUM(`taxsame`) AS taxsame,	SUM(`workeradd`) AS workeradd, SUM(`workersame`) AS workersame,	SUM(`poweradd`) AS poweradd, SUM(`powersame`) AS powersame,	CASE WHEN town = \'虞山镇\' THEN \'高新开发区\' WHEN town = \'经济开发区\' THEN \'碧溪新区\' ELSE town END AS aaa FROM middletowndata GROUP BY aaa,`month` ORDER BY	`month` DESC LIMIT 13');
        $hotmapdata = array();
        function tongbi($add, $same){
            return ($add - $same) / $same;
        }
        foreach ($data as $item){
            $newitem = new \stdClass();
                if ($item->aaa == '高新开发区'){
                    $newitem->镇区 = '虞山镇+高新开发区';
                } elseif ($item->aaa == '碧溪新区'){
                    $newitem->镇区 = '碧溪新区+经济开发区';
                } else {
                    $newitem->镇区 = $item->aaa;
                }
                $newitem->产值累计 = $item->outputadd;
                $newitem->产值同比 = tongbi($item->outputadd, $item->outputsame);
                $newitem->利税累计 = $item->taxadd;
                $newitem->利税同比 = tongbi($item->taxadd, $item->taxsame);
                $newitem->用工累计 = $item->workeradd;
                $newitem->用工同比 = tongbi($item->workeradd, $item->workersame);
                $newitem->用电累计 = $item->poweradd;
                $newitem->用电同比 = tongbi($item->poweradd, $item->powersame);
                array_push($hotmapdata, $newitem);
        }
        return json_encode($hotmapdata);
    }

    public function bankdata (){
        // 银行资金流量
        $data = DB::select('SELECT `month` AS \'月份\', `money` AS \'资金量\' FROM middlebankdata ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function chinamap (){
        // 物流、客流热力图
        $data = DB::select('SELECT middlelogistics.area AS \'区域\', Sum(middlelogistics.sendweight) AS `物流发货量`, Sum(middlelogistics.arriveweight) AS `物流到达量`, (SELECT SUM(count) from middlecustomer mc where mc.area =middlelogistics.area GROUP BY mc.area ) AS \'客流量\'
FROM middlelogistics GROUP BY middlelogistics.area
');
        return json_encode($data);
    }

    public function arrivelogistics (){
        // 银行资金流量
        $data = DB::select('SELECT `month` AS \'月份\', `money` AS \'资金\' FROM middlebankdata ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function sendlogistics (){
        // 物流发货量top5
        $data = DB::select('SELECT city, sendweight FROM middlelogistics ORDER BY sendweight DESC LIMIT 5');
        return json_encode($data);
    }

    public function marketsale (){
        // 市场交易TOP15
        $data = DB::select('SELECT `month` AS \'月份\', `market` AS \'市场\', `money` AS \'交易额\' FROM middlemarketdata ORDER BY `month` DESC LIMIT 16');
        return json_encode($data);
    }
}

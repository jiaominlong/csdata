<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiddleScreenController extends Controller
{
    const THISMONTH = '201711';
    const LASTMONTH = '201710';
    public function total (){
        // 数据汇总 V2
        $data = DB::select('SELECT month, category, unit, `data` FROM middletotal ORDER BY `month` LIMIT 4');
        return json_encode($data);
    }

    public function marketcate (){
        // 市场交易类别占比 V2
        $data = DB::select('SELECT month, category, unit, `data` FROM middlemarketcate WHERE `month` = '.self::THISMONTH.' ORDER BY `data` DESC');
        return json_encode($data);
    }

    public function towndata (){
        // 乡镇热力图  V2
        $data = DB::select('SELECT `month`, `town`, `outputadd`, outputsame, taxadd, taxsame, workeradd, workersame, poweradd, powersame FROM middletowndata WHERE MONTH = '.self::LASTMONTH.' ORDER BY `town` DESC');
        $hotmapdata = array();
        function tongbi($add, $same){
            return ($add - $same) / $same;
        }
        foreach ($data as $item){
            $newitem = new \stdClass();
                $newitem->month = $item->month;
                $newitem->town = $item->town;
                $newitem->outputadd = $item->outputadd;
                $newitem->outputtongbi = tongbi($item->outputadd, $item->outputsame);
                $newitem->taxadd = $item->taxadd;
                $newitem->taxtongbi = tongbi($item->taxadd, $item->taxsame);
                $newitem->workeradd = $item->workeradd;
                $newitem->workertongbi = tongbi($item->workeradd, $item->workersame);
                $newitem->poweradd = $item->poweradd;
                $newitem->powertongbi = tongbi($item->poweradd, $item->powersame);
                array_push($hotmapdata, $newitem);
        }
        return json_encode($hotmapdata);
    }

    public function bankdata (){
        // 银行资金流量 V2
        $data = DB::select('SELECT `month`, `money` FROM middlebankdata ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function chinamap (){
        // 物流、客流热力图
        $data = DB::select('SELECT middlelogistics.area , Sum(middlelogistics.sendweight) AS \'sendweight\', Sum(middlelogistics.arriveweight) AS \'arriveweight\', (SELECT SUM(count) from middlecustomer mc where mc.area =middlelogistics.area GROUP BY mc.area ) AS \'customer\'
FROM middlelogistics GROUP BY middlelogistics.area ORDER BY middlelogistics.area DESC
');
        return json_encode($data);
    }

    public function arrivelogistics (){
        // 物流到货量
        $data = DB::select('SELECT `month`, city, arriveweight FROM middlelogistics WHERE `month` = '.self::LASTMONTH.' ORDER BY arriveweight DESC LIMIT 5');
        return json_encode($data);
    }

    public function sendlogistics (){
        // 物流发货量top5
        $data = DB::select('SELECT `month`, city, sendweight FROM middlelogistics WHERE `month` = '.self::LASTMONTH.' ORDER BY sendweight DESC LIMIT 5');
        return json_encode($data);
    }

    public function marketsale (){
        // 市场交易TOP15
        $data = DB::select('SELECT `month`, `market`, `money` FROM middlemarketdata WHERE `month` = '.self::THISMONTH.' ORDER BY `money` DESC');
        return json_encode($data);
    }
}

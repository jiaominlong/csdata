<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiddleScreenController extends Controller
{
    public function total (){
        // 数据汇总 V2
        $data = DB::select('SELECT month, category, unit, `data` FROM middletotal ORDER BY `month` LIMIT 4');
        return json_encode($data);
    }

    public function marketcate (){
        // 市场交易类别占比 V2
        $data = DB::select('SELECT month, category, unit, `data` FROM middlemarketcate ORDER BY `month` LIMIT 4');
        return json_encode($data);
    }

    public function towndata (){
        // 乡镇热力图  V2
        $data = DB::select('SELECT `month`, `town`, `outputadd`, outputsame, taxadd, taxsame, workeradd, workersame, poweradd, powersame FROM middletowndata');
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
        // 银行资金流量
        $data = DB::select('SELECT `month`, `money` FROM middlebankdata ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function chinamap (){
        // 物流、客流热力图
        $data = DB::select('SELECT middlelogistics.area , Sum(middlelogistics.sendweight) AS \'sendweight\', Sum(middlelogistics.arriveweight) AS \'arriveweight\', (SELECT SUM(count) from middlecustomer mc where mc.area =middlelogistics.area GROUP BY mc.area ) AS \'customer\'
FROM middlelogistics GROUP BY middlelogistics.area
');
        return json_encode($data);
    }

    public function arrivelogistics (){
        // 物流到货量
        $data = DB::select('SELECT `month`, city, arriveweight FROM middlelogistics ORDER BY arriveweight DESC LIMIT 5');
        return json_encode($data);
    }

    public function sendlogistics (){
        // 物流发货量top5
        $data = DB::select('SELECT `month`, city, sendweight FROM middlelogistics ORDER BY sendweight DESC LIMIT 5');
        return json_encode($data);
    }

    public function marketsale (){
        // 市场交易TOP15
        $data = DB::select('SELECT `month`, `market`, `money` FROM middlemarketdata ORDER BY `month` DESC LIMIT 16');
        return json_encode($data);
    }
}

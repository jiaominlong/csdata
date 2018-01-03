<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiddleScreenController extends Controller
{
    /**********  服装城数据汇总  **********/
    public function total (){
        $data = DB::select('SELECT month, category, unit, `data` FROM middletotal ORDER BY `month` DESC LIMIT 5');
        return json_encode($data);
    }

    /**********  服装城市场交易品类占比  **********/
    public function marketcate (){
        // 市场交易类别占比 V2
        $thisyearmonth = DB::select('SELECT `month` FROM middlemarketcate ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('SELECT month, category, unit, `data` FROM middlemarketcate WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY `data` DESC');
        return json_encode($data);
    }

    /**********  乡镇热力图  **********/
    public function towndata (){
        // 乡镇热力图  V2
        $thisyearmonth = DB::select('SELECT `month` FROM middletowndata ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('SELECT `month`, `town`, `outputadd`, outputsame, taxadd, taxsame, workeradd, workersame, poweradd, powersame FROM middletowndata WHERE MONTH = '.$thisyearmonth[0]->month.' ORDER BY `town` DESC');
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

    /**********  服装城银行平均日资金流量  **********/
    public function bankdata (){
        // 银行资金流量 V2
        $data = DB::select('SELECT `month`, `money` FROM middlebankdata ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    /**********  服装城客流、物流热力图  **********/
    public function chinamap (){
        /* 为保证数据一致性，物流数据更新比较晚，所以时间依物流表中最新时间为准 */
        // 从物流表里获取物流最新数据的时间
        $time = DB::select('SELECT `month` FROM middlelogistics ORDER BY `month` DESC LIMIT 1')[0]->month;
        // 获取最新物流数据
        $logistics = DB::select('SELECT `month`, `area`, SUM(sendweight) AS sendweight, SUM(arriveweight) AS arriveweight FROM middlelogistics WHERE `month` = '.$time.' GROUP BY area ORDER BY `area` DESC');
        // 获取对应物流时间的客流数据
        $customer = DB::select('SELECT `area`, SUM(count) AS customer1 FROM middlecustomer WHERE `month` = '.$time.' GROUP BY `area`');
        // 组成新的数组进行返回
        foreach ($logistics as $log) {
            for ($i = 0; $i<count($customer); $i++){
                if ($log->area == $customer[$i]->area) {
                    $log->customer = $customer[$i]->customer1;
                }
            }
        }
        return json_encode($logistics);
    }

    /**********  服装城物流发货量  **********/
    public function sendlogistics (){
        $thisyearmonth = DB::select('SELECT `month` FROM middlelogistics ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('SELECT `month`, city, sendweight FROM middlelogistics WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY sendweight DESC LIMIT 5');
        return json_encode($data);
    }

    /**********  服装城物流到达量  **********/
    public function arrivelogistics (){
        $thisyearmonth = DB::select('SELECT `month` FROM middlelogistics ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('SELECT `month`, city, arriveweight FROM middlelogistics WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY arriveweight DESC LIMIT 5');
        return json_encode($data);
    }

    /**********  服装城市场交易数据  **********/
    public function marketsale (){
        // 市场交易TOP15
        $thisyearmonth = DB::select('SELECT `month` FROM middlemarketdata ORDER BY `month` DESC LIMIT 1');
        $data = DB::select('SELECT `month`, `market`, `money` FROM middlemarketdata WHERE `month` = '.$thisyearmonth[0]->month.' ORDER BY `money` DESC');
        return json_encode($data);
    }
}

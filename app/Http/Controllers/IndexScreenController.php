<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexScreenController extends Controller
{
//    排序函数
    function newSort($arr) {
        $flag = array();
        foreach($arr as $v){
            $flag[] = $v['sale_new'];
        }
        array_multisort($flag, SORT_DESC, $arr);
        return $arr;
    }

    /*************男装内销价格指数 V3**************/
    public function neixiaoprice(){
        // 获取数据库中最新的月份和旬数
        $lasttime = DB::select('SELECT `month`, `times` FROM indexnxprice ORDER BY `month` DESC , `times` DESC LIMIT 1');
        // 使用最新的月份和旬  进行查询
        $data = DB::select('SELECT `month`, times, category, zengsu, huanbi, dingji, tongbi FROM indexnxprice WHERE month = '.$lasttime[0]->month.' AND times = '.$lasttime[0]->times);
        return json_encode($data);
    }
    /*************男装内销价格总指数走势 V3**************/
    public function neixiaopricetotalindex(){
        // 依照月份从打到小获取最新的12个值
        $data = DB::select('SELECT month, dingji, tongbi, huanbi FROM indexnxpricetotaltrend ORDER BY month DESC LIMIT 12');
        return json_encode($data);
    }

    /*************男装内销价格 大类定基指数走势 V3**************/
    public function neixiaobigcateindex(){
        $data = array();
        $dataInit = DB::select('SELECT month, category, `index` FROM indexnxbigcatetrend WHERE category in ('.self::CATEGORY.') ORDER BY `month` DESC, `category` DESC LIMIT 36');
        for ($i=0; $i < count($dataInit)/3; $i++){
            $offse = $i * 3;
            $newArr = array_slice($dataInit, $offse, 3);
            $tempArr = array(
                'month'=>$newArr[0]->month,
                'type1_name'=>$newArr[0]->category,
                'type2_name'=>$newArr[1]->category,
                'type3_name'=>$newArr[2]->category,
                'type1_value'=>$newArr[0]->index,
                'type2_value'=>$newArr[1]->index,
                'type3_value'=>$newArr[2]->index,
            );
            array_push($data, $tempArr);
        }
        return json_encode($data);
    }

    /*************男装景气指数 V3**************/
    public function manjingqiindex(){
        // 获取最新时间
        $lastttime = DB::select('SELECT `month` FROM indexjingqiindex ORDER BY `month` DESC LIMIT 1');
        // 使用获取的最新时间 进行查询
        $data = DB::select('SELECT month, category, `index` FROM indexjingqiindex WHERE month = '.$lastttime[0]->month.' LIMIT 5');
        return json_encode($data);
    }

    /**************男装行业景气指数走势 V3**************/
    public function manjingqiindexindu(){
        //获取最新的年月
        $lasttime = DB::select('SELECT `month` FROM indexjingqiindu ORDER BY `month` DESC LIMIT 1');
        // 获取最新年
        $thisyear = substr($lasttime[0]->month, 0, 4);
        // 计算得到上一年
        $lastyear = (string)((int)$thisyear - 1);
        $data = DB::select('SELECT `month`, `index` FROM indexjingqiindu WHERE `month` LIKE \''.$lastyear.'%\' OR `month` LIKE \''.$thisyear.'%\' ORDER BY `month` DESC');
        return json_encode($data);
    }

    /**************男装分类景气指数走势 V3**************/
    public function manjingqiindexcate(){
        $data = array();
        $data1 = DB::select('SELECT `month`, `category`, `index` FROM indexjingqicate WHERE category in (\'生产\',\'市场\') ORDER BY `month` DESC, `category` DESC LIMIT 24');
        for ($i=0; $i < count($data1)/2; $i++){
            $offse = $i * 2;
            $newArr = array_slice($data1, $offse, 2);
            $tempArr = array(
                'month'=>$newArr[0]->month,
                'type1_name'=>$newArr[0]->category,
                'type2_name'=>$newArr[1]->category,
                'type1_value'=>$newArr[0]->index,
                'type2_value'=>$newArr[1]->index,
            );
            array_push($data, $tempArr);
        }
        return json_encode($data);
    }
    /**************男装市场大类销售占比 V3**************/
    public function marketcatesale(){
        $data = array();
        // 查出最新的年月
        $lasttime = DB::select('SELECT `month` FROM marketcatesale ORDER BY `month` DESC LIMIT 1');
        // 最新年月
        $thisyearmonth = $lasttime[0]->month;
        // 最新年份
        $findnum = substr($thisyearmonth, 0, 4);
        // 上一年分
        $replacenum = (string)((int)$findnum - 1);
        // 上一年分对应的月
        $lastyearmonth = str_replace($findnum, $replacenum, $thisyearmonth);
        // 组合成时间
        $alltime = $thisyearmonth.','.$lastyearmonth;
        $data1 = DB::select('SELECT `month`, `category`, `index` AS \'sale\' FROM marketcatesale WHERE `month` IN ('.$alltime.') ORDER BY category DESC, `month` DESC');
        for ($i=0; $i < count($data1)/2; $i++){
            $offse = $i * 2;
            $newArr = array_slice($data1, $offse, 2);
            $tempArr = array(
                'category'=>$newArr[0]->category,
                'month'=>$newArr[0]->month,
                'sale_new'=>$newArr[0]->sale,
                'sale_old'=>$newArr[1]->sale,
            );
            array_push($data, $tempArr);
        }
        return json_encode($this->newSort($data));
    }

    /**************男装淘宝、天猫销售数据 V3**************/
    public function onlinesaledata(){
        $thisyear = DB::select('SELECT `month` FROM indexsaledata ORDER BY `month` LIMIT 1');
        $data = DB::select('SELECT `month`, `category`, `sale`, `huanbi`, `tongbi` FROM indexsaledata WHERE month ='.$thisyear[0]->month.' ORDER BY sale DESC');
        return json_encode($data);
    }

    /**************淘宝、天猫交易情况 V3**************/
    public function onlinesale(){
        $data = DB::select('SELECT `month`, `sale`, `salecount` FROM indexonlinesale ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    /**************男装淘宝、天猫各大类销售占比 V3**************/
    public function onlinecate(){
        $data = array();
        // 查出最新的年月
        $lasttime = DB::select('SELECT `month` FROM indexonlinecate ORDER BY `month` DESC LIMIT 1');
        // 最新年月
        $thisyearmonth = $lasttime[0]->month;
        // 最新年份
        $findnum = substr($thisyearmonth, 0, 4);
        // 上一年分
        $replacenum = (string)((int)$findnum - 1);
        // 上一年分对应的月
        $lastyearmonth = str_replace($findnum, $replacenum, $thisyearmonth);
        // 组合成时间
        $alltime = $thisyearmonth.','.$lastyearmonth;
        $data1 = DB::select('SELECT `month`, `category`, `sale` FROM indexonlinecate WHERE `month` IN ('.$alltime.') ORDER BY `category` DESC, `month` DESC');
        for ($i=0; $i < count($data1)/2; $i++){
            $offse = $i * 2;
            $newArr = array_slice($data1, $offse, 2);
            $tempArr = array(
                'category'=>$newArr[0]->category,
                'month'=>$newArr[0]->month,
                'sale_new'=>$newArr[0]->sale,
                'sale_old'=>$newArr[1]->sale,
            );
            array_push($data, $tempArr);
        }
        return json_encode($this->newSort($data));
    }
}

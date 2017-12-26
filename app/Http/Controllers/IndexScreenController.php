<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexScreenController extends Controller
{
    const THISYEAR = '2017';
    const LASTYEAR = '2016';
    const THISMONTH = '11'; # 定义当前月份
    const LASTMONTH = '10'; # 上个月
    const THISTIME = '3'; #定义询指数  可以 为 1 2 3 三个值
    const CATEGORY = "'全棉休闲衬衫','全棉长裤','休闲羽绒服'";
    const MARKETCATEGORY = '\'休闲羽绒服\', \'T恤\', \'夹克\', \'棉服\', \'全棉休闲衬衫\', \'全棉长裤\', \'风衣\', \'西服\''; #市场大类销售占比



//    排序函数
    function newSort($arr) {
        $flag = array();
        foreach($arr as $v){
            $flag[] = $v['sale_new'];
        }
        array_multisort($flag, SORT_DESC, $arr);
        return $arr;
    }
    //
    public function neixiaoprice(){
        // 男装内销价格指数 V2
        $data = DB::select('SELECT `month`, times, category, zengsu, huanbi, dingji, tongbi FROM indexnxprice WHERE month = '.self::THISYEAR.self::THISMONTH.' AND times = '.self::THISTIME);
        return json_encode($data);
    }

    public function neixiaopricetotalindex(){
        // 男装内销价格总指数走势 V2
        $data = DB::select('SELECT month, dingji, tongbi, huanbi FROM indexnxpricetotaltrend ORDER BY month DESC LIMIT 12');
        return json_encode($data);
    }

    public function neixiaobigcateindex(){
        // 男装内销价格总指数走势 V2
        $data = array();
        $dataInit = DB::select('SELECT month, category, `index` FROM indexnxbigcatetrend WHERE category in ('.self::CATEGORY.') ORDER BY `month` DESC, `category` DESC');
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

    public function manjingqiindex(){
        // 男装景气指数 V2
        $data = DB::select('SELECT month, category, `index` FROM indexjingqiindex WHERE month = '.self::THISYEAR.self::THISMONTH.' LIMIT 5');
        return json_encode($data);
    }

    public function manjingqiindexindu(){
        // 男装行业景气指数 V2
        $data = DB::select('SELECT `month`, `index` FROM indexjingqiindu WHERE `month` LIKE \''.self::LASTYEAR.'%\' OR `month` LIKE \''.self::THISYEAR.'%\' ORDER BY `month` DESC');
//        此处注销掉年份
        //        $newDate = new \stdClass();
//        $newDate->{self::THISYEAR} = array();
//        $newDate->{self::LASTYEAR} = array();
//        foreach ($data as $item) {
//            if (strstr($item->month, self::THISYEAR)){
//                array_push($newDate->{self::THISYEAR}, $item);
//            }else{
//                array_push($newDate->{self::LASTYEAR}, $item);
//            }
//        }
        return json_encode($data);
    }

    public function manjingqiindexcate(){
        // 男装类别景气指数 V2
        $data = array();
        $data1 = DB::select('SELECT `month`, `category`, `index` FROM indexjingqicate WHERE category in (\'生产\',\'市场\') ORDER BY `month` DESC, `category` DESC');
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

    public function marketcatesale(){
        // 市场大类销售占比
        $data = array();
        $data1 = DB::select('SELECT `month`, `category`, `index` AS \'sale\' FROM marketcatesale WHERE `category` IN ('.self::MARKETCATEGORY.') ORDER BY category DESC, `month` DESC');
        for ($i=0; $i < count($data1)/2; $i++){
            $offse = $i * 2;
            $newArr = array_slice($data1, $offse, 2);
            $tempArr = array(
                'category'=>$newArr[0]->category,
                'sale_new'=>$newArr[0]->sale,
                'sale_old'=>$newArr[1]->sale,
            );
            array_push($data, $tempArr);
        }
        return json_encode($this->newSort($data));
    }

    public function onlinesale(){
        // 市场交易额区县V2
        $data = DB::select('SELECT `month`, `sale`, `salecount` FROM indexonlinesale ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function onlinecate(){
        // 淘宝天猫各大类销售占比 V2
        $data = array();
        $data1 = DB::select('SELECT `month`, `category`, `sale` FROM indexonlinecate WHERE `month` LIKE \'%'.self::THISMONTH.'%\' ORDER BY `category` DESC, `month` DESC');
        for ($i=0; $i < count($data1)/2; $i++){
            $offse = $i * 2;
            $newArr = array_slice($data1, $offse, 2);
            $tempArr = array(
                'category'=>$newArr[0]->category,
                'sale_new'=>$newArr[0]->sale,
                'sale_old'=>$newArr[1]->sale,
            );
            array_push($data, $tempArr);
        }
        return json_encode($this->newSort($data));
    }

    public function onlinesaledata(){
        // 淘宝天猫各销售数据 V2
        $data = DB::select('SELECT `month`, `category`, `sale`, `huanbi`, `tongbi` FROM indexsaledata WHERE month ='.self::THISYEAR.self::THISMONTH.' ORDER BY sale DESC');
        return json_encode($data);
    }
}

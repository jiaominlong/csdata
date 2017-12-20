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
    const CATEGORY1 = '全棉休闲衬衫'; #男装内销价格总指数走势
    const CATEGORY2 = '全棉长裤';  #男装内销价格总指数走势
    const CATEGORY3 = '休闲羽绒服'; #男装内销价格总指数走势
    const MARKETCATEGORY = '\'休闲羽绒服\', \'T恤\', \'夹克\', \'棉服\', \'全棉休闲衬衫\', \'全棉长裤\', \'风衣\', \'西服\''; #市场大类销售占比



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
        $data1 = DB::select('SELECT month, category, `index` FROM indexnxbigcatetrend WHERE category = \''.self::CATEGORY1.'\' ORDER BY month DESC LIMIT 12');
        $data2 = DB::select('SELECT month, category, `index` FROM indexnxbigcatetrend WHERE category = \''.self::CATEGORY2.'\' ORDER BY month DESC LIMIT 12');
        $data3 = DB::select('SELECT month, category, `index` FROM indexnxbigcatetrend WHERE category = \''.self::CATEGORY3.'\' ORDER BY month DESC LIMIT 12');
        $data = array_merge($data1, $data2, $data3);
        return json_encode($data);
    }

    public function manjingqiindex(){
        // 男装景气指数 V2
        $data = DB::select('SELECT month, category, `index` FROM indexjingqiindex WHERE month = '.self::THISYEAR.self::THISMONTH.' LIMIT 5');
        return json_encode($data);
    }

    public function manjingqiindexindu(){
        // 男装行业景气指数 V2
        $data = DB::select('SELECT `month`, `index` FROM indexjingqiindu WHERE `month` LIKE \''.self::LASTYEAR.'%\' OR `month` LIKE \''.self::THISYEAR.'%\' ');
        $newDate = new \stdClass();
        $newDate->{self::THISYEAR} = array();
        $newDate->{self::LASTYEAR} = array();
        foreach ($data as $item) {
            if (strstr($item->month, self::THISYEAR)){
                array_push($newDate->{self::THISYEAR}, $item);
            }else{
                array_push($newDate->{self::LASTYEAR}, $item);
            }
        }
        return json_encode($newDate);
    }

    public function manjingqiindexcate(){
        // 男装类别景气指数 V2
        $data = array();
        $data1 = DB::select('SELECT `month`, `category`, `index` FROM indexjingqicate WHERE category = \'生产\' ORDER BY month DESC LIMIT 12');
        $data2 = DB::select('SELECT `month`, `category`, `index` FROM indexjingqicate WHERE category = \'市场\' ORDER BY month DESC LIMIT 12');
        $data = array_merge($data1, $data2);
        return json_encode($data);
    }

    public function marketcatesale(){
        // 市场大类销售占比
        $data = new \stdClass();
        $data1 = DB::select('SELECT `month`, `category`, `index` AS \'sale\' FROM marketcatesale WHERE `category` IN ('.self::MARKETCATEGORY.') AND month = '.self::THISYEAR.self::THISMONTH.' LIMIT 10');
        $data2 = DB::select('SELECT `month`, `category`, `index` AS \'sale\' FROM marketcatesale WHERE `category` IN ('.self::MARKETCATEGORY.') AND month = '.self::LASTYEAR.self::THISMONTH.' LIMIT 10');
        $data->{self::THISYEAR} = $data1;
        $data->{self::LASTYEAR} = $data2;
        return json_encode($data);
    }

    public function onlinesale(){
        // 市场交易额区县V2
        $data = DB::select('SELECT `month`, `sale`, `salecount` FROM indexonlinesale ORDER BY `month` DESC LIMIT 12');
        return json_encode($data);
    }

    public function onlinecate(){
        // 淘宝天猫各大类销售占比 V2
        $data = new \stdClass();
        $data->{self::THISYEAR.self::THISMONTH} = array();
        $data->{self::LASTYEAR.self::THISMONTH} = array();
        $cateArr = DB::select('SELECT `category` FROM indexonlinecate WHERE `month` = '.self::THISYEAR.self::THISMONTH.' ORDER BY `category`');
        $data->{self::THISYEAR.self::THISMONTH} = DB::select('SELECT `month`, `category`, `sale` FROM indexonlinecate WHERE `month` = '.self::THISYEAR.self::THISMONTH.' ORDER BY `category`');
        foreach ($cateArr as $item){
            $sql = sprintf('SELECT `month`, `category`, `sale` FROM indexonlinecate WHERE `month` = '.self::LASTYEAR.self::THISMONTH.' AND `category` = \'%s\'', $item->category);
            array_push($data->{self::LASTYEAR.self::THISMONTH}, DB::select($sql)[0]);
        }
        return json_encode($data);
    }

    public function onlinesaledata(){
        // 淘宝天猫各销售数据 V2
        $data = DB::select('SELECT `month`, `category`, `sale`, `huanbi`, `tongbi` FROM indexsaledata WHERE month ='.self::THISYEAR.self::THISMONTH.' ORDER BY sale DESC');
        return json_encode($data);
    }
}

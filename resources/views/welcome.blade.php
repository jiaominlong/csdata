<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            ul{
                margin: 0 auto;
            }
            a{
                color: #333;
                text-decoration: none;
            }
            h1 {
                color: #2ab27b;
            }
        </style>
    </head>
    <body>
            <div>
                <ul>
                    <h1>外贸屏幕数据接口</h1>
                    <li><a href="/foreigntrade/totals">出口金额报关单趋势</a></li>
                    <li><a href="/foreigntrade/qgindex">男装全国出口价格指数</a></li>
                    <li><a href="/foreigntrade/csindex">男装常熟出口价格指数</a></li>
                    <li><a href="/foreigntrade/country">出口抵运国TOP5</a></li>
                    <li><a href="/foreigntrade/area">抵运区域分析</a></li>
                    <li><a href="/foreigntrade/category">各类商品出口占比</a></li>
                    <li><a href="/foreigntrade/route">一带一路出口情况</a></li>
                </ul>

                <ul>
                    <h1>中间屏幕数据接口</h1>
                    <li><a href="/middle/total">数据汇总</a></li>
                    <li><a href="/middle/marketcate">市场交易品类占比</a></li>
                    <li><a href="/middle/towndata">乡镇热力图</a></li>
                    <li><a href="/middle/bankdata">服装城银行资金流量</a></li>
                    <li><a href="/middle/chinamap">客流、物流热力图</a></li>
                    <li><a href="/middle/sendlogistics">物流发货量TOP5</a></li>
                    <li><a href="/middle/arrivelogistics">物流到达量TOP5</a></li>
                    <li><a href="/middle/marketsale">市场交易TOP20</a></li>
                </ul>

                <ul>
                    <h1>指数屏幕数据接口</h1>
                    <li><a href="/index/neixiaoprice">男装内销价格指数</a></li>
                    <li><a href="/index/neixiaopricetotalindex">男装内销价格总指数走势</a></li>
                    <li><a href="/index/neixiaobigcateindex">男装内销价格 大类定基指数走势</a></li>
                    <li><a href="/index/manjingqiindex">男装景气指数</a></li>
                    <li><a href="/index/manjingqiindexindu">男装行业景气指数走势</a></li>
                    <li><a href="/index/manjingqiindexcate">男装分类景气指数走势</a></li>
                    <li><a href="/index/marketcatesale">男装市场各大类销售占比</a></li>
                    <li><a href="/index/onlinesaledata">男装淘宝、天猫销售数据</a></li>
                    <li><a href="/index/onlinesale">市场总交易额曲线图</a></li>
                    <li><a href="/index/onlinecate">男装淘宝、天猫各大类销售占比</a></li>
                </ul>
            </div>
    </body>
</html>

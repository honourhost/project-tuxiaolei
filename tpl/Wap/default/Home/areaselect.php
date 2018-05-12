<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <title>选择城市</title>

    <style>


        * {
            margin: 0;
            padding: 0;
            outline: 0
        }


        body {
            font-family: Hiragino Sans GB, Arial, Helvetica, "宋体", sans-serif;
            font-size: 14px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            background-color: #f0f0f0
        }


        a, input, textarea {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
        }

        input, textarea {
            resize: none
        }

        ol, ul {
            list-style: none
        }

        a {
            text-decoration: none
        }

        del {
            text-decoration: line-through
        }

        header {
            height: 45px;
            line-height: 45px;
            padding: 0 10px;
            text-align: center;
            color: #333;
            position: relative;
            display: box;
            display: -webkit-box;
            display: -ms-flexbox;
            z-index: 300
        }

        header .back {
            padding-left: 18px;
            position: relative;
            color: #333;
            display: block
        }

        header .back:before {
            border: #666 solid 3px;
            position: absolute;
            left: 4px;
            top: 50%;
            margin-top: -8px;
            display: block;
            content: '';
            width: 12px;
            height: 12px;
            border-top: none;
            border-right: none;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg)
        }

        header .city {
            position: relative;
            padding-right: 17px;
            color: #333;
            display: block
        }

        header .city:after {
            border: #333 solid 1px;
            position: absolute;
            right: 2px;
            top: 50%;
            margin-top: -8px;
            display: block;
            content: '';
            width: 8px;
            height: 8px;
            border-top: none;
            border-right: none;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg)
        }

        header .search {
            height: 30px;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            padding: 8px 0 8px 10px;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            border: solid 1px #c8c8c8
        }

        header .placeholder {
            -webkit-box-flex: 1;
            box-flex: 1;
            -ms-box-flex: 1;
            -ms-flex: 1
        }

        header .title {
            font-size: 16px;
            position: absolute;
            width: 180px;
            height: 100%;
            text-align: center;
            left: 50%;
            margin-left: -90px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #000
        }

        .layout_header .back {
            top: 22px
        }

        .malllist-head .search-box {
            margin: 0 10px;
            -webkit-box-flex: 1;
            box-flex: 1;
            -ms-box-flex: 1;
            -ms-flex: 1
        }

        .malllist-head .search-box input {
            height: 30px;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            padding: 8px 0 8px 10px;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            border: solid 1px #c8c8c8;
            width: 100%
        }

        .header-fixed {
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            background-color: #fff;
            z-index: 300
        }

        .search-result {
            margin-top: 84px
        }

        footer {
            text-align: center;
            padding: 10px 5px;
            font-weight: 400;
            font-size: 12px;
            padding-top: 15px
        }

        footer a {
            color: #adadad;
            line-height: 28px
        }

        footer em {
            color: #8c8c8c;
            padding: 0 12px;
            font-weight: 400;
            font-style: normal
        }

        footer .copyright {
            color: #d1d1d1;
            margin-top: 20px;
            text-shadow: 0 1px 1px #fff
        }

        .hot-trade .hd {
            padding-left: 10px;
            font-size: 14px;
            color: #323232;
            line-height: 30px;
            background-color: #f2f2f2;
            border-bottom: 1px solid #e2e2e2;
            font-weight: 700;
            display: block
        }

        .home-place-list {
            overflow: hidden;
            background-color: #fff
        }

        .home-place-list ul {
            font-size: 0
        }

        .home-place-list li {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            display: inline-block;
            width: 33%;
            line-height: 48px;
            border-bottom: 1px solid #ededed;
            border-right: 1px solid #ededed;
            text-align: center;
            color: #323232;
            font-size: 16px
        }

        .home-place-list li a {
            display: block;
            color: #323232;
            overflow: hidden;
            white-space: nowrap
        }

        .position-city {
            line-height: 45px;
            background-color: #FFF;
            text-align: center
        }

        .position-city a {
            color: #ff9c00;
            font-size: 26px;
            padding-left: 10px;
            font-weight: 400
        }

        .letter-list li {
            width: 20% !important
        }

        .list-type-cnt {
            padding-top: 7px;
            -webkit-box-flex: 1;
            box-flex: 1;
            -ms-box-flex: 1;
            -ms-flex: 1
        }

        .list-type {
            width: 150px;
            height: 30px;
            margin: 0 auto;
            text-align: center
        }

        .list-type a {
            color: #ff8400;
            width: 50%;
            height: 100%;
            float: left;
            line-height: 28px;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: solid 1px #ff8400
        }

        .list-type a:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px
        }

        .list-type a:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px
        }

        .list-type a.on {
            background-color: #ff8400;
            color: #fff
        }

        /*# sourceMappingURL=../css/citylist.css.map */
    </style>



</head>

<body>

<header>
    <a href="javascript:history.go(-1);" class="back">返回</a>

    <div class="placeholder"></div>
    <div class="title">

        <section>
            <div class="list-type-cnt">
                <div class="list-type">
                    <a href="#" class="on">{pigcms{$pagename}</a>
                    <a href="wap.php?cityid=2268">青岛</a>
                </div>
            </div>
        </section>

    </div>

</header>

<section>
    <div class="position-city J_citylist">
        <span class="text">

            <a href="wap.php?cityid=<?php  echo $_SESSION['cityarr']['0']['area_id']; ?>">
                <?php  echo $_SESSION['cityarr']['0']['area_name']; ?>

            </a>
        </span>
        <a></a>
    </div>
    <div class="hot-trade modebox">
        <div class="hd">所有城市</div>
        <div class="home-place-list">
            <ul class="J_citylist">
           	    <if condition="$arearlistarr">
                <volist name="arearlistarr" id="vo">

                    <li> <a href="wap.php?cityid={pigcms{$vo.area_id}"> {pigcms{$vo.area_name} </a> </li>

                </volist>
                </if>
            </ul>
        </div>
    </div>

</section>

<div class="scroll-top" id="srcollTop"></div>

<div class="appload">
</div>




</body>




</html>
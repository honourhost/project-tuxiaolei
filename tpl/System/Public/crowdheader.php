<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="tpl/Merchant/static/css/styles.css">
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.ba-bbq.min.js"></script>
    <title>{pigcms{$config.site_name} - 商家中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="tpl/Merchant/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/font-awesome.min.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/jquery-ui.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/jquery-ui.min.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/ace-fonts.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/ace.min.css" id="main-ace-style">
    <link rel="stylesheet" href="tpl/Merchant/static/css/ace-skins.min.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/ace-rtl.min.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/global.css">
    <link rel="stylesheet" href="tpl/Merchant/static/css/jquery-ui-timepicker-addon.css">
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.ba-bbq.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/ace-extra.min.js"></script>


    <script type="text/javascript" src="tpl/Merchant/static/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script type="text/javascript" src="tpl/Merchant/static/js/bootbox.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.sparkline.min.js"></script>

    <!-- ace scripts -->
    <script type="text/javascript" src="tpl/Merchant/static/js/ace-elements.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/ace.min.js"></script>

    <script type="text/javascript" src="tpl/Merchant/static/js/jquery.yiigridview.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery-ui-i18n.min.js"></script>
    <script type="text/javascript" src="tpl/Merchant/static/js/jquery-ui-timepicker-addon.min.js"></script>
    <style type="text/css">
        .jqstooltip {
            position: absolute;
            left: 0px;
            top: 0px;
            visibility: hidden;
            background: rgb(0, 0, 0) transparent;
            background-color: rgba(0, 0, 0, 0.6);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
            -ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
            color: white;
            font: 10px arial, san serif;
            text-align: left;
            white-space: nowrap;
            padding: 5px;
            border: 1px solid white;
            z-index: 10000;
        }

        .jqsfield {
            color: white;
            font: 10px arial, san serif;
            text-align: left;
        }

        .statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
            display: none;
        }

        #shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
        {
            font-size: 12px;
            color: black;
            display: none;
            width: 100%;
        }
    </style>
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>
</head>
<body class='no-skin'>
<include file="Public:nav"/>
<div class="main-container" id="main-container" >
    <include file="Public:left"/>
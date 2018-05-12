<?php
/*
 * 项目公共配置
 *
 */
return array(

	/*加载额外配置文件*/
	'LOAD_EXT_CONFIG' 		=> 'db',		
	'APP_AUTOLOAD_PATH'     => '@.ORG',
	
	//'OUTPUT_ENCODE'         => true, 			//页面压缩输出
	
	/*URL配置*/
	'URL_MODEL' 			=> '0',
	
	/*分组配置*/
	'APP_GROUP_LIST' 		=> 'Index,Group,Meal,User,Merchant,System,Lottery,WapMerchant', 	//项目分组设定
	'DEFAULT_GROUP' 		=> 'Index', 			//默认分组
	
	/*系统变量名称设置*/
	'VAR_MODULE'  			=> 'c',				//将系统默认的m改为c
	
	/*Cookie配置*/
	'COOKIE_PATH'           => '/',     		// Cookie路径
    'COOKIE_PREFIX'         => '',      		// Cookie前缀 避免冲突
	
	/*定义模版标签*/
	'TMPL_L_DELIM'   		=> '{pigcms{',		//模板引擎普通标签开始标记
	'TMPL_R_DELIM'			=> '}',				//模板引擎普通标签结束标记
	'TMPL_TEMPLATE_SUFFIX'	=> '.php',			//默认模板文件后缀
	
	/*常用文件定义*/
	'JQUERY_FILE' 			=> 'http://libs.baidu.com/jquery/1.7.0/jquery.min.js',				// Jquery 文件
	'JQUERY_FILE_190' 			=> 'http://libs.baidu.com/jquery/1.9.0/jquery.min.js',				// Jquery 文件 1.9.0
	
	
	/*跳转的模板文件*/
	'TMPL_ACTION_SUCCESS'   => TMPL_PATH.'error.php',
	'TMPL_ACTION_ERROR'     => TMPL_PATH.'error.php',
	
	/*缓存*/
	'DATA_CACHE_SUBDIR'		=> true,
	'DATA_PATH_LEVEL'		=> 2,
	
	'VAR_FILTERS' => 'arr_htmlspecialchars',
	
	'TAGLIB_PRE_LOAD' => 'pigcms' ,
	/*调试*/
	//'SHOW_PAGE_TRACE' =>true,
	"PAY_LIMIT"=>true,
	"PAY_RANGE"=>true,
	"PAY_RANGE_TOPIC"=>"618",
	"PAY_RANGE_NUMBER"=>6,
	"PAY_LIMIT_GROUP"=>"824,865,895,919,835,955,983,787,1057,1063,1075,1080,1081,1086,1067,1087,1066,1085,1090,1091,1095,1072,1092,1099,1100,1136,1237",//关闭了不加了799,820,
	"PAY_LIMIT_NUMBER"=>0,
    'UMENG_IOS_APP_KEY'      => '5a0a649bf29d9863f10002cb', //友盟ios AppKey
    'UMENG_IOS_SECRET'       => 'mur4hl6vqdg1menrg1kytz40mjbf09in', //友盟ios App Master Secret
    'UMENG_ANDROID_APP_KEY'  => '5979a8953eae251308001b46', //友盟android AppKey
    'UMENG_ANDROID_SECRET'   => 'velnosgwpe9ewtptrdfq152a879rwwqr', //友盟android App Master Secret
);
?>
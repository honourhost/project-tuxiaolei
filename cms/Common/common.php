<?php
/*
 * 截取中文字符串	
 */
function msubstr($str,$start=0,$length,$suffix=true,$charset="utf-8"){
    if(function_exists("mb_substr")){
        if ($suffix && mb_strlen($str, $charset)>$length)
            return mb_substr($str, $start, $length, $charset)."...";
        else
            return mb_substr($str, $start, $length, $charset);
    }elseif(function_exists('iconv_substr')) {
        if ($suffix && strlen($str)>$length)
            return iconv_substr($str,$start,$length,$charset)."...";
        else
            return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

function arr_htmlspecialchars(&$value){
	$value = htmlspecialchars($value);
}

function fulltext_filter($value){
	return htmlspecialchars_decode($value);
}

    /**
     * 加密和解密函数
     *
     * <code>
     * // 加密用户ID和用户名
     * $auth = authcode("{$uid}\t{$username}", 'ENCODE');
     * // 解密用户ID和用户名
     * list($uid, $username) = explode("\t", authcode($auth, 'DECODE'));
     * </code>
     *
     * @access public
     * @param  string  $string    需要加密或解密的字符串
     * @param  string  $operation 默认是DECODE即解密 ENCODE是加密
     * @param  string  $key       加密或解密的密钥 参数为空的情况下取全局配置encryption_key
     * @param  integer $expiry    加密的有效期(秒)0是永久有效 注意这个参数不需要传时间戳
     * @return string
     */
    function Encryptioncode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key != '' ? $key : 'lhs_simple_encryption_code_45120');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

 /*****
 **生成简单的随机数
 **$length 需要的长度
 **$onlynum 生成纯数字的
 **$nouppLetter  不需要大写的，数字和小写的混合
 **/
function createRandomStr($length=6,$onlynum=false,$nouppLetter=false){
	if(!($length>0)) return false;
	$returnstr='';
	if($onlynum){
	   for($i=0;$i<$length;$i++){
	     $returnstr .= rand(0,9);
	   }
	}else if($nouppLetter){
	   $strarr = array_merge(range(0,9),range('a','z'));
	   shuffle($strarr);
	   shuffle($strarr);
	   $returnstr = implode('',array_slice($strarr,0,$length));
	}else{
	  $strarr = array_merge(range(0,9),range('a','z'),range('A','Z'));
	  shuffle($strarr);
	  shuffle($strarr);
	  $returnstr = implode('',array_slice($strarr,0,$length));
	}
    return $returnstr;
}

/**
 * *封装一个通用的
 * cURL封装**
 * *$postfields 参数
 * */
function httpRequest($url, $method = 'GET', $postfields = null, $headers = array(), $debug = false) {
    /* $Cookiestr = "";  * cUrl COOKIE处理* 
      if (!empty($_COOKIE)) {
      foreach ($_COOKIE as $vk => $vv) {
      $tmp[] = $vk . "=" . $vv;
      }
      $Cookiestr = implode(";", $tmp);
      } */
    $method = strtoupper($method);
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    switch ($method) {
        case "POST":
            curl_setopt($ci, CURLOPT_POST, true);
            if (!empty($postfields)) {
                $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
                curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
            }
            break;
        default:
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
            break;
    }
    $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;
    curl_setopt($ci, CURLOPT_URL, $url);
    if ($ssl) {
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
    }
    //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ci, CURLOPT_MAXREDIRS, 2); /* 指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的 */
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, true);
    /* curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
    $response = curl_exec($ci);
    $requestinfo = curl_getinfo($ci);
    $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    if ($debug) {
        echo "=====post data======\r\n";
        var_dump($postfields);
        echo "=====info===== \r\n";
        print_r($requestinfo);

        echo "=====response=====\r\n";
        print_r($response);
    }
    curl_close($ci);
    return array($http_code, $response, $requestinfo);
}

/** 
* @desc 根据两点间的经纬度计算距离 
* @param float $lat 纬度值 
* @param float $lng 经度值 
*/
function getDistance($lat1, $lng1, $lat2, $lng2){
	$earthRadius = 6367000;
	$lat1 = ($lat1 * pi() ) / 180;
	$lng1 = ($lng1 * pi() ) / 180;

	$lat2 = ($lat2 * pi() ) / 180;
	$lng2 = ($lng2 * pi() ) / 180;

	$calcLongitude = $lng2 - $lng1;
	$calcLatitude = $lat2 - $lat1;
	$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
	$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
	$calculatedDistance = $earthRadius * $stepTwo;
	return round($calculatedDistance);
} 

function getRange($range,$space = true){
	if($range < 1000){
		return $range.($spage ? ' ' : '').'m';
	}else{
		return floatval(round($range/1000,2)).($spage ? ' ' : '').'km';
	}
}
//根据农场id获取农小店id
function getStoreId($mer_id){
    if(!empty($mer_id)){
        $store=D("Merchant_store")->where(array("mer_id"=>$mer_id,"status"=>1))->find();
        return $store['store_id'];
    }else{
        return "";
    }
}

//根据农场area_id获取农小店城市名
function getAreaName($area_id){
    if(!empty($area_id)){
        $Area=D("Area");
        $now_area=$Area->where("area_id=".$area_id)->find();
        $pare_area=$Area->where("area_id=".$now_area['area_pid'])->find();
        return $pare_area['area_name'];
    }else{
        return "未知";
    }
}
//根据农场area_id获取城市和区名
function getRealAreaName($area_id){
    if(!empty($area_id)){
        $Area=D("Area");
        $now_area=$Area->where("area_id=".$area_id)->find();
        $pare_area=$Area->where("area_id=".$now_area['area_pid'])->find();
        return $pare_area['area_name'].$now_area['area_name'];
    }else{
        return "未知";
    }
}
//截取字符串，为了添加省略号
function getStrSub($str){
    if(!empty($str)){
        return mb_substr($str,0,80,"utf-8")."...";
    }else{
        return "字符串有错误";
    }
}
//获取活动的结束时间
function getEndTime($id){
    if(!empty($id)){
        $term=D("Extension_activity")->where("activity_id=".$id)->find();
        return date('Y-m-d',$term['end_time']);
    }else{
        return "未知";
    }
}

//获取分类下商品的方法
function getCatGoodsList($id){
    if(!empty($id)){
        $goods=D("Channel_category_goods")->where("cat_id=".$id)->select();
        $goods=array_filter($goods);
        if(!empty($goods)){
            foreach($goods as $key=>$val){
                $list[]=D('Group')->get_group_by_groupId($val['goods_id']);
            }
        return $list;
        }else{
            return "";
        }
    }else{
        return "";
    }
}
//获取相应的广告图list
function getAdvList($str,$cat_type){
    $check=strval($str);
    $cat_type=intval($cat_type);
    if(!empty($check)){
        $cat_key=$check;
        $data=array(
            "cat_key"=>$cat_key,
            "cat_type"=>$cat_type
            );
        //先查询出对应的分类id
        $category=D("Adver_category")->where($data)->find();
        //在查询出对应的广告list
        if(!empty($category)){
            $where=array(
                "cat_id"=>$category['cat_id'],
                "status"=>1
                );
            $list=D("Adver")->where($where)->order("sort DESC")->select();
            $list=array_filter($list);
            if(!empty($list)){
                return $list;
            }else{
                return "";
            }
        }    
    }else{
         return "";
    }
}

//根据特卖id获取价格
function getGroupPrice($group_id){
    if(!empty($group_id)){
        $group=M("Group")->find($group_id);
        if(!empty($group)){
            return $group['price'];
        }else{
            return "未知";
        }
    }else{
        return "未知";
    }
}

function getAvatar($user_id){
    if($user_id) {
        $now_user = D("User")->find($user_id);
        if (strstr($now_user['avatar'], ",")) {
            $avatar_image_class = new avatar_image();

            $image = $avatar_image_class->get_image_by_path($now_user['avatar'], C('config.site_url'));
            $now_user['avatar'] = $image['s_image'];
        }
        return $now_user['avatar'];
    }
        return "";
}
//根据用户id获取用户名
function getUserName($user_id){
if($user_id) {
        $now_user = D("User")->find($user_id);
        if($now_user){
             return $now_user['nickname'];
        }else{
             return "";
        }
    }
        return "";
}

function getMerchantPic($id){
        if(empty($id)){
            return false;
        }
        $now_merchant = M("Merchant")->field(true)->where(array('mer_id'=>$id))->find();
        if(empty($now_merchant)){
            return false;
        }
        $merchant_image_class = new merchant_image();
        if($now_merchant['person_image']) {
            $images = explode(";", $now_merchant['person_image']);
            $images = explode(";", $images[0]);
            $now_merchant['img'] = $merchant_image_class->get_image_by_path($images[0]);
        }
        return $now_merchant['img'];
}


 function timeFromNow($dateline)
{
    if (empty($dateline)) return false;
    $seconds = time() - $dateline;
    if ($seconds < 60) {
        return "1分钟前";
    } elseif ($seconds < 3600) {
        return floor($seconds / 60) . "分钟前";
    } elseif ($seconds < 24 * 3600) {
        return floor($seconds / 3600) . "小时前";
    } elseif ($seconds < 48 * 3600) {
        return date("昨天 H:i", $dateline) . "";
    } else {
        return date('Y-m-d', $dateline);
    }
}


function create_uuid($prefix = ""){    
    $str = md5(uniqid(mt_rand(), true));
    $uuid  = substr($str,0,8) . '-';
    $uuid .= substr($str,8,4) . '-';
    $uuid .= substr($str,12,4) . '-';
    $uuid .= substr($str,16,4) . '-';
    $uuid .= substr($str,20,12);
    return $prefix . $uuid;
}

/**
 * 发送友盟推送消息
 * @param  integer  $uid   用户id
 * @param  string   $title 推送的标题
 * @return boolear         是否成功
 */
function umeng_push($uid,$title){
    // 获取token
//    $device_tokens=D('OauthUser')->getToken($uid,2);
    $device_tokens="AjRw-31Hr8JbrzyB8s5oKQQXzPKKeKspQGQ_POe1GD5t";
    // 如果没有token说明移动端没有登录；则不发送通知
//    if (empty($device_tokens)) {
//        return false;
//    }
    // 导入友盟
    Vendor('Umeng.Umeng');
    // 自定义字段   根据实际环境分配；如果不用可以忽略
    $status=1;
    // 消息未读总数统计  根据实际环境获取未读的消息总数 此数量会显示在app图标右上角
    $count_number=1;
    $data=array(
        'key'=>'status',
        'value'=>"$status",
        'count_number'=>$count_number
    );
    // 判断device_token  64位表示为苹果 否则为安卓
    if(strlen($device_tokens)==64){
        $key=C('UMENG_IOS_APP_KEY');
        $timestamp=C('UMENG_IOS_SECRET');
        $umeng=new \Umeng($key, $timestamp);
        $umeng->sendIOSUnicast($data,$title,$device_tokens);
    }else{
        $key=C('UMENG_ANDROID_APP_KEY');
        $timestamp=C('UMENG_ANDROID_SECRET');
        $umeng=new \Umeng($key, $timestamp);
      //  file_put_contents("upush.txt",$key."------".$timestamp,FILE_APPEND);
        $umeng->sendAndroidUnicast($data,$title,$device_tokens);
    }
    return true;
}
?>
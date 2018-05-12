<?php
final class Sms
{
	public $topdomain;
	
	public $key;
	
	public $smsapi_url;
	
	/**
	 * 
	 * 初始化接口类
	 * @param int $userid 用户id
	 * @param int $productid 产品id
	 * @param string $sms_key 密钥
	 */
	public function __construct()
	{
		
	}
	
	public function checkmobile($mobilephone)
	{
		$mobilephone = trim($mobilephone);
		if (preg_match("/^1[0-9]{10}$/", $mobilephone)) {
			return  $mobilephone;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * 批量发送短信
	 * @param array $mobile 手机号码
	 * @param string $content 短信内容
	 * @param datetime $send_time 发送时间
	 * @param string $charset 短信字符类型 gbk / utf-8
	 * @param string $id_code 唯一值 、可用于验证码
	 * $data = array(mer_id, store_id, content, mobile, uid, type);
	 */
	public function sendSms($data = array(), $send_time = '', $charset = 'utf-8', $id_code = '')
	{
		if ($data) {
			             
				
			$type = isset($data['type']) ? $data['type'] : 'meal';
			$sendto = isset($data['sendto']) ? $data['sendto'] : 'user';
			$mer_id = isset($data['mer_id']) ? intval($data['mer_id']) : 0;
			$store_id = isset($data['store_id']) ? intval($data['store_id']) : 0;
			$uid = isset($data['uid']) ? intval($data['uid']) : 0;
			if (empty($mer_id)) return 'mer_id is null';
			$content = isset($data['content']) ? Sms::_safe_replace($data['content']) : '';
			if (empty($content)) return 'send content is null';
			$mobile = isset($data['mobile']) ? $data['mobile'] : '';
			$phone_array = explode(',', $mobile);
			$mobile = $pre = '';
			foreach ($phone_array as $phone) {
				if (Sms::checkmobile($phone)) {
					$mobile .= $pre . $phone;
					$pre = ',';
				}
			}
			if (empty($mobile)) return 'phone is right';
			$data = '';
			$post = '';
			foreach ($data as $k => $v) {
				$post .= $k . '=' . $v .'&';
			}
			$smsapi_senturl =  C('config.sms_api');
		//$site_name=C('config.site_name');
		if($mer_id==686){
			$site_name="一品清真";
		}	
		else{
			$site_name=C('config.site_name');
			
		}
				//$site_name=	(($mer_id==686)?"一品清真":C('config.site_name'));
			$uid = C('config.sms_uid');
			$upsd = C('config.sms_pwd');
			if($upsd = C('config.sms_pwd')){
				$upsd = md5($upsd);
			}
			
			$data=array(
				"uid"=>$uid,
				"upsd"=>$upsd,
				"sendtele"=>$mobile,
				"msg"=>$content,
				"sign"=>$site_name
			);
		
			  $fo2=fopen("group2.txt","a+");
                               fwrite($fo2,"before_lottery------------- "."\n".json_encode( $data).date("Y-m-d H:i:s",time())."\n");
                               fclose($fo2);
			$return = Sms::new_post($smsapi_senturl,$data);
				  $fo=fopen("group2.txt","a+");
                               fwrite($fo,"now_lottery------------- ".json_encode( $return)."\n".json_encode( $data).date("Y-m-d H:i:s",time())."\n");
                               fclose($fo);
                           
			if(strpos($return,"success")!==false){
				$sms_status=0;
			}elseif($return=="error01"){
				$sms_status=-1;
			}elseif($return=="error02"){
				$sms_status=-2;
			}elseif($return=="error03"){
				$sms_status=-3;
			}elseif($return=="error04"){
				$sms_status=-4;
			}elseif($return=="error05"){
				$sms_status=-5;
			}elseif($return=="error06"){
				$sms_status=-6;
			}elseif($return=="error07"){
				$sms_status=-7;
			}elseif($return=="error08"){
				$sms_status=-8;
			}elseif($return=="error09"){
				$sms_status=-9;
			}elseif($return=="error10"){
				$sms_status=-10;
			}else{
				$sms_status=-11;
			}
		
			$send_time = $send_time ? $send_time : time();
			
			//增加到本地数据库
			$row = array('pigcms_id'=> $pigcms_id,'mer_id' => $mer_id, 'uid' => $uid, 'store_id' => $store_id, 'time' => $send_time, 'phone' => $mobile, 'text' => $content, 'status' =>$sms_status, 'type' => $type, 'sendto' => $sendto);
			D('sms_record')->add($row);
			
			return $return;
		} else return false;
		
		exit;
		if (C('sms_key') != '' && C('sms_key') != 'key') {
			$companyid=0;
			
			if(!(strpos($token,'_') === FALSE)) {
				$sarr = explode('_',$token);
				$token = $sarr[0];
				$companyid = intval($sarr[1]);
			}
			if (!$mobile) {
				$companyWhere = array();
				$companyWhere['token'] = $token;
				if ($companyid) {
					$companyWhere['id'] = $companyid;
				}
				$company = M('Company')->where($companyWhere)->find();
				$mobile = $company['mp'];
			}
			//
			$thisWxUser = M('Wxuser')->where(array('token' => Sms::_safe_replace($token)))->find();
			$thisUser = M('Users')->where(array('id' => $thisWxUser['uid']))->find();
			if ($token == 'admin') {
				$thisUser = array('id'=>0);
				$thisWxUser = array('uid' => 0,'token' => $this->token);
			}
			
			if (intval($thisUser['smscount']) < 1 && $token != 'admin'){
				return '已用完或者未购买短信包';
				exit();
			} else {
				//
				//短信发送状态
				if(is_array($mobile)){
					$mobile = implode(",", $mobile);
				}
	
				$content = Sms::_safe_replace($content);
				$data = array(
					'topdomain' => C('config.server_topdomain'),
					'key' => trim(C('config.sms_key')),
					'token' => $token,
					'content' => $content,
					'mobile' => $mobile,
					'sign' => trim(C('config.sms_sign'))
				);
				$post = '';
				foreach ($data as $k => $v) {
					$post .= $k . '=' . $v .'&';
				}
	
				$smsapi_senturl = C('config.sms_api');
	
				$return = Sms::_post($smsapi_senturl, 0, $post);
				$arr = explode('#', $return);
				$this->statuscode = $arr[0];
				//增加到本地数据库
				if ($mobile) {
					$row = array('uid' => $thisUser['id'], 'token' => $thisWxUser['token'], 'time' => time(), 'mp' => $mobile, 'text' => $content, 'status' => $this->statuscode, 'price' => C('sms_price'));
					M('Sms_record')->add($row);
					if (intval($this->statuscode) == 0 && $token != 'admin'){
						M('Users')->where(array('id' => $thisWxUser['uid']))->setDec('smscount');
					}
				}
				//end
				return $return;
			}
		}
	}
	/**
	 *
	 * 发送验证码
	 * @param array $mobile 手机号码
	 * @param string $content 短信内容
	 * @param datetime $send_time 发送时间
	 * @param string $charset 短信字符类型 gbk / utf-8
	 * @param string $id_code 唯一值 、可用于验证码（这里没用）
	 * $data = array(content, mobile);
	 */
	public static function sendVerifySms($data = array(), $send_time = '', $charset = 'utf-8', $id_code = '')
	{
		if ($data) {
			$content = isset($data['content']) ? Sms::_safe_replace($data['content']) : '';
			if (empty($content)) return 'send content is null';
			$mobile = isset($data['mobile']) ? $data['mobile'] : '';
			$phone_array = explode(',', $mobile);
			$mobile = $pre = '';
			foreach ($phone_array as $phone) {
				if (Sms::checkmobile($phone)) {
					$mobile .= $pre . $phone;
					$pre = ',';
				}
			}
			if (empty($mobile)) return 'phone is right';
			$data = '';
			$post = '';
			foreach ($data as $k => $v) {
				$post .= $k . '=' . $v .'&';
			}
			$smsapi_senturl =  C('config.sms_api');
			$site_name=C('config.site_name');
			$uid = C('config.sms_uid');
			$upsd = C('config.sms_pwd');
			if($upsd = C('config.sms_pwd')){
				$upsd = md5($upsd);
			}
			$data=array(
				"uid"=>$uid,
				"upsd"=>$upsd,
				"sendtele"=>$mobile,
				"msg"=>$content,
				"sign"=>$site_name
			);
			$return = Sms::new_post($smsapi_senturl,$data);

			if(strpos($return,"success")!==false){
				$sms_status=1;
			}elseif($return=="error01"){
				$sms_status=-1;
			}elseif($return=="error02"){
				$sms_status=-2;
			}elseif($return=="error03"){
				$sms_status=-3;
			}elseif($return=="error04"){
				$sms_status=-4;
			}elseif($return=="error05"){
				$sms_status=-5;
			}elseif($return=="error06"){
				$sms_status=-6;
			}elseif($return=="error07"){
				$sms_status=-7;
			}elseif($return=="error08"){
				$sms_status=-8;
			}elseif($return=="error09"){
				$sms_status=-9;
			}elseif($return=="error10"){
				$sms_status=-10;
			}else{
				$sms_status=-11;
			}
			$send_time = $send_time ? $send_time : time();

			//增加到本地数据库
			$row = array('mobile'=> $mobile,'create_time' => $send_time, 'verify_code' => $id_code,'status' =>$sms_status);
			D('Mobile_login_verify')->add($row);
			return $return;
		} else return false;

		exit;
		if (C('sms_key') != '' && C('sms_key') != 'key') {
			$companyid=0;

			if(!(strpos($token,'_') === FALSE)) {
				$sarr = explode('_',$token);
				$token = $sarr[0];
				$companyid = intval($sarr[1]);
			}
			if (!$mobile) {
				$companyWhere = array();
				$companyWhere['token'] = $token;
				if ($companyid) {
					$companyWhere['id'] = $companyid;
				}
				$company = M('Company')->where($companyWhere)->find();
				$mobile = $company['mp'];
			}
			//
			$thisWxUser = M('Wxuser')->where(array('token' => Sms::_safe_replace($token)))->find();
			$thisUser = M('Users')->where(array('id' => $thisWxUser['uid']))->find();
			if ($token == 'admin') {
				$thisUser = array('id'=>0);
				$thisWxUser = array('uid' => 0,'token' => $this->token);
			}

			if (intval($thisUser['smscount']) < 1 && $token != 'admin'){
				return '已用完或者未购买短信包';
				exit();
			} else {
				//
				//短信发送状态
				if(is_array($mobile)){
					$mobile = implode(",", $mobile);
				}

				$content = Sms::_safe_replace($content);
				$data = array(
						'topdomain' => C('config.server_topdomain'),
						'key' => trim(C('config.sms_key')),
						'token' => $token,
						'content' => $content,
						'mobile' => $mobile,
						'sign' => trim(C('config.sms_sign'))
				);
				$post = '';
				foreach ($data as $k => $v) {
					$post .= $k . '=' . $v .'&';
				}

				$smsapi_senturl = C('config.sms_api');

				$return = Sms::_post($smsapi_senturl, 0, $post);
				$arr = explode('#', $return);
				$this->statuscode = $arr[0];
				//增加到本地数据库
				if ($mobile) {
					$row = array('uid' => $thisUser['id'], 'token' => $thisWxUser['token'], 'time' => time(), 'mp' => $mobile, 'text' => $content, 'status' => $this->statuscode, 'price' => C('sms_price'));
					M('Sms_record')->add($row);
					if (intval($this->statuscode) == 0 && $token != 'admin'){
						M('Users')->where(array('id' => $thisWxUser['uid']))->setDec('smscount');
					}
				}
				//end
				return $return;
			}
		}
	}
	/**
	 *  post数据
	 *  @param string $url		post的url
	 *  @param int $limit		返回的数据的长度
	 *  @param string $post		post数据，字符串形式username='dalarge'&password='123456'
	 *  @param string $cookie	模拟 cookie，字符串形式username='dalarge'&password='123456'
	 *  @param string $ip		ip地址
	 *  @param int $timeout		连接超时时间
	 *  @param bool $block		是否为阻塞模式
	 *  @return string			返回字符串
	 */
	
	private function _post($url, $limit = 0, $post = '', $cookie = '', $ip = '', $timeout = 15, $block = true)
	{
		$return = '';
		$url = str_replace('&amp;', '&', $url);
		$matches = parse_url($url);
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'] . ($matches['query'] ? '?' . $matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;
		$siteurl = Sms::_get_url();
		if ($post) {
			$out = "POST $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n" ;
			$out .= 'Content-Length: '.strlen($post)."\r\n" ;
			$out .= "Connection: Close\r\n" ;
			$out .= "Cache-Control: no-cache\r\n" ;
			$out .= "Cookie: $cookie\r\n\r\n" ;
			$out .= $post ;
		} else {
			$out = "GET $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		if(!$fp) return '';
		
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
	
		if($status['timed_out']) return '';	
		while (!feof($fp)) {
			if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n"))  break;				
		}
		
		$stop = false;
		while(!feof($fp) && !$stop) {
			$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
			$return .= $data;
			if($limit) {
				$limit -= strlen($data);
				$stop = $limit <= 0;
			}
		}
		@fclose($fp);

		//部分虚拟主机返回数值有误，暂不确定原因，过滤返回数据格式
		$return_arr = explode("\n", $return);
		if(isset($return_arr[1])) {
			$return = trim($return_arr[1]);
		}
		unset($return_arr);
		
		return $return;
	}
	//新的post请求类
	private function new_post($url,$post_data){
		curl_init();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		return $output;
	}

	/**
	 * 获取当前页面完整URL地址
	 */
	private function _get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? Sms::_safe_replace($_SERVER['PHP_SELF']) : Sms::_safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? Sms::_safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? Sms::_safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.Sms::_safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
	
	/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	private function _safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}
}
?>
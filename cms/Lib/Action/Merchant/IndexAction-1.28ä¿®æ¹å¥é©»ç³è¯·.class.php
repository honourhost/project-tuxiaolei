<?php
/*
 * 商户中心管理首页
 *
 */

class IndexAction extends BaseAction{
    public function index(){
		
		//商家公告
		$database_merchant_news = D('Merchant_news');
		$news_list = $database_merchant_news->field(true)->order('`is_top` DESC,`add_time` DESC')->limit(10)->select();
		$this->assign('news_list',$news_list);
		
		/**  商家数据统计 **/
		$mer_id = $this->merchant_session['mer_id'];
		//粉丝数量
		$pigcms_data['fans_count'] = M('')->table(array(C('DB_PREFIX').'merchant_user_relation'=>'m',C('DB_PREFIX').'user'=>'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$mer_id'")->count();
		//会员卡数量
		$pigcms_data['card_count'] = M('Member_card_create')->where(array('token'=>$mer_id,'wecha_id'=>array('neq','')))->count();
		//微活动数量
		$pigcms_data['lottery_count'] = M('Lottery')->where(array('mer_id'=>$mer_id))->count();
		//店铺数量
		$pigcms_data['store_count'] = M('Merchant_store')->where(array('mer_id'=>$mer_id,'status'=>array('neq',4)))->count();

		$this->assign($pigcms_data);
		
		$now=D("Merchant")->where("mer_id=".$mer_id)->find();
		$this->assign("merchant",$now);
		
		$this->display();
    }

    //入住的申请页
	public function ruzhu(){
		//判断是否已经存在，如果已经存在直接跳转到申请页
		$this->checkExitVerify();
		$this->display();
	}
	//判断是否已存在认证申请
	public function checkExitVerify(){
		//查询两张表看是否存在
		$company=D("Merchant_verify")->where("mer_id=".$this->merchant_session['mer_id'])->find();
		if(!empty($company)){
			//图片显示
			$merchant_image_class = new merchant_image();
			$company['business_liscence_image'] = $merchant_image_class->get_image_by_path($company['business_liscence_image'],$this->config['site_url'],'s');

			$company['legal_represent_cardimage'] = $merchant_image_class->get_image_by_path($company['legal_represent_cardimage'],$this->config['site_url'],'s');

			$company['company_handcardimage'] = $merchant_image_class->get_image_by_path($company['company_handcardimage'],$this->config['site_url'],'s');
			if($company['status']==2){
				$flag=1;
				$this->assign("flag",$flag);
			}
			$this->assign("company",$company);
			$this->display("Index/companyResponse");
			exit;
		}else{
			$person=D("Person_verify")->where("mer_id=".$this->merchant_session['mer_id'])->find();
			if(!empty($person)){
				//图片显示
				$merchant_image_class = new merchant_image();
				$person['person_cardimage'] = $merchant_image_class->get_image_by_path($person['person_cardimage'],$this->config['site_url'],'s');

				$person['person_handcardimage'] = $merchant_image_class->get_image_by_path($person['person_handcardimage'],$this->config['site_url'],'s');
				if($person['status']==2){
					$flag=1;
					$this->assign("flag",$flag);
				}
				$this->assign("person",$person);
				$this->display("Index/personResponse");
				exit;
			}
		}
	}
	//公司身份认证方法
	public function companyVerify(){
		if(IS_POST){
			if(empty($_POST['company_name'])||empty($_POST['company_info'])||empty($_POST['business_liscence_no'])||empty($_POST['legal_represent'])||empty($_POST['legal_represent_cardno'])){
				$this->error("请确保所有参数都已填写！");
			}else{
				$data['company_name']=$_POST['company_name'];
				$data['company_info']=$_POST['company_info'];
				$data['business_liscence_no']=$_POST['business_liscence_no'];
				$data['legal_represent']=$_POST['legal_represent'];
				$data['legal_represent_cardno']=$_POST['legal_represent_cardno'];
			}
			//新增相关信息的照片上传存储
			if(!empty($_FILES)){
				if(empty($_FILES['business_liscence_image'])&&empty($_FILES['legal_represent_cardimage'])&&($_FILES['company_handcardimage'])){
						$this->error("证件照上传出现错误！");
				}
				if($_FILES['business_liscence_image']['error'] != 4&&$_FILES['legal_represent_cardimage']['error']!=4&&$_FILES['company_handcardimage']['error']!=4){
					$param = array('size' => $this->config['meal_pic_size']);
					$param['thumb'] = true;
					$param['imageClassPath'] = 'ORG.Util.Image';
					$param['thumbPrefix'] = 'm_,s_';
					$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
					$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
					$param['thumbRemoveOrigin'] = false;
					$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
					if ($image['error']) {
						$this->error('图片上传过程出错');
					} else {
						$_POST = array_merge($_POST, $image['title']);
						$data['business_liscence_image']=$_POST['business_liscence_image'];
						$data['legal_represent_cardimage']=$_POST['legal_represent_cardimage'];
						$data['company_handcardimage']=$_POST['company_handcardimage'];
					}
				}else{
					$this->error("证件上传过程出现错误，请重试！");
				}
			}else{
				$this->error("需要上传相关证件照片才能提交！");
			}
			$data['mer_id']=$this->merchant_session['mer_id'];
			$data['create_time']=time();
			//保存进表中
			if(D("Merchant_verify")->data($data)->add()){
				$this->success("申请已提交，请等待审核结果！",U("Index/ruzhu"));
			}else{
				$this->error("申请提交失败，请重试！");
			}
		}
	}
	//个人身份认证方法
	public function personVerify(){
		if(IS_POST){
			if(empty($_POST['person_name'])||empty($_POST['person_cardno'])||empty($_POST['person_farm_info'])){
				$this->error("请确保所有参数都已填写！");
			}else{
				$data['person_name']=$_POST['person_name'];
				$data['person_cardno']=$_POST['person_cardno'];
				$data['person_farm_info']=$_POST['person_farm_info'];
			}
			//新增相关信息的照片上传存储
			if(!empty($_FILES)){
				if(empty($_FILES['person_cardimage'])&&empty($_FILES['person_handcardimage'])){
					$this->error("证件照上传出现错误！");
				}
				if($_FILES['person_cardimage']['error'] != 4&&$_FILES['person_handcardimage']['error']!=4){
					$param = array('size' => $this->config['meal_pic_size']);
					$param['thumb'] = true;
					$param['imageClassPath'] = 'ORG.Util.Image';
					$param['thumbPrefix'] = 'm_,s_';
					$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
					$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
					$param['thumbRemoveOrigin'] = false;
					$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
					if ($image['error']) {
						$this->error('图片上传过程出错');
					} else {
						$_POST = array_merge($_POST, $image['title']);
						$data['person_cardimage']=$_POST['person_cardimage'];
						$data['person_handcardimage']=$_POST['person_handcardimage'];
					}
				}else{
					$this->error("证件上传过程出现错误，请重试！");
				}
			}else{
				$this->error("需要上传相关证件照片才能提交！");
			}
			$data['mer_id']=$this->merchant_session['mer_id'];
			$data['create_time']=time();
			//保存进表中
			if(D("Person_verify")->data($data)->add()){
				$this->success("申请已提交，请等待审核结果！",U("Index/ruzhu"));
			}else{
				$this->error("申请提交失败，请重试！");
			}
		}
	}
	//重新编辑商家申请
	public function companyVerifyEdit(){
		if(!empty($_POST)){
			//先查询看是否存在该申请
			$merchantVerify=D("Merchant_verify");
			$now=$merchantVerify->where("id=".$_POST['id'])->find();
			if(empty($now)){
				$this->error("不存在该申请！");
			}
			if(empty($_POST['company_name'])||empty($_POST['company_info'])||empty($_POST['business_liscence_no'])||empty($_POST['legal_represent'])||empty($_POST['legal_represent_cardno'])){
				$this->error("请确保所有参数都已填写！");
			}else{
				$data['company_name']=$_POST['company_name'];
				$data['company_info']=$_POST['company_info'];
				$data['business_liscence_no']=$_POST['business_liscence_no'];
				$data['legal_represent']=$_POST['legal_represent'];
				$data['legal_represent_cardno']=$_POST['legal_represent_cardno'];
			}
			//相关信息的照片修改存储
			if($_FILES['business_liscence_image']['error'] != 4 || $_FILES['legal_represent_cardimage']['error']!=4 || $_FILES['company_handcardimage']['error']!=4){
				$param = array('size' => $this->config['meal_pic_size']);
				$param['thumb'] = true;
				$param['imageClassPath'] = 'ORG.Util.Image';
				$param['thumbPrefix'] = 'm_,s_';
				$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
				$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
				$param['thumbRemoveOrigin'] = false;
				$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
				if ($image['error']) {
					$this->error('图片上传过程出错');
				} else {
					$_POST = array_merge($_POST, $image['title']);
					if($_FILES['business_liscence_image']['error'] != 4){
						$data['business_liscence_image']=$_POST['business_liscence_image'];
					}
					if($_FILES['legal_represent_cardimage']['error'] != 4){
						$data['legal_represent_cardimage']=$_POST['legal_represent_cardimage'];
					}
					if($_FILES['company_handcardimage']['error'] != 4){
						$data['company_handcardimage']=$_POST['company_handcardimage'];
					}
				}
			}
			$data['mer_id']=$this->merchant_session['mer_id'];
			//改变状态为等待审核状态
			$data['create_time']=time();
			$data['status']=0;
			if($merchantVerify->where("id=".$now['id'])->save($data)){
				$this->success("申请已修改并提交，请等待审核结果！",U("Index/ruzhu"));
			}else{
				$this->error("申请修改失败，请重试！");
			}
		}
	}
	//重新编辑个人申请
	public function personVerifyEdit(){
		if(!empty($_POST)){
			//先查询看是否存在该申请
			$personVerify=D("Person_verify");
			$now=$personVerify->where("id=".$_POST['id'])->find();
			if(empty($now)){
				$this->error("不存在该申请！");
			}
			if(empty($_POST['person_name'])||empty($_POST['person_cardno'])||empty($_POST['person_farm_info'])){
				$this->error("请确保所有参数都已填写！");
			}else{
				$data['person_name']=$_POST['person_name'];
				$data['person_cardno']=$_POST['person_cardno'];
				$data['person_farm_info']=$_POST['person_farm_info'];
			}
			//相关信息的照片修改存储
				if($_FILES['person_cardimage']['error'] != 4 || $_FILES['person_handcardimage']['error']!=4){
					$param = array('size' => $this->config['meal_pic_size']);
					$param['thumb'] = true;
					$param['imageClassPath'] = 'ORG.Util.Image';
					$param['thumbPrefix'] = 'm_,s_';
					$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
					$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
					$param['thumbRemoveOrigin'] = false;
					$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
					if ($image['error']) {
						$this->error('图片上传过程出错');
					} else {
						$_POST = array_merge($_POST, $image['title']);
						if($_FILES['person_cardimage']['error'] != 4){
							$data['person_cardimage']=$_POST['person_cardimage'];
						}
						if($_FILES['person_handcardimage']['error'] != 4){
							$data['person_handcardimage']=$_POST['person_handcardimage'];
						}
					}
				}
			$data['mer_id']=$this->merchant_session['mer_id'];
			//修改审核状态为待审核
			$data['create_time']=time();
			$data['status']=0;
			if($personVerify->where("id=".$now['id'])->save($data)){
				$this->success("申请已修改并提交，请等待审核结果！",U("Index/ruzhu"));
			}else{
				$this->error("申请修改失败，请重试！");
			}
		}
	}

	
	public function news($id){
		$database_merchant_news = D('Merchant_news');
		$condition_merchant_news['id'] = $id;
		$now_news = $database_merchant_news->field(true)->where($condition_merchant_news)->find();
		if(empty($now_news)){
			$this->error('当前内容不存在！');
		}
		$this->assign('now_news',$now_news);
		
		$this->display();
	}
	public function ping(){
		echo 'success';
	}
}
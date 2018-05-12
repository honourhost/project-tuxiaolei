<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 17:16
 */
class TicketAction extends BaseAction{
    public function index(){
        //100元券，固定的为
        $id="66588";
        $qrcode_return = D('Recognition')->get_perm_qrcode($id);
        if($qrcode_return['error_code']){
            echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
        }else{
            $this->assign($qrcode_return);
            $this->display();
        }
    }
    public function weixin(){
        $_SESSION['weixin']['key']=$_GET['secret'];
        $_SESSION['weixin']['referer'] = !empty($_GET['referer']) ? htmlspecialchars_decode($_GET['referer']) : U('My/index',array("secret"=>$_GET['secret']));
        $_SESSION['weixin']['state']   = md5(uniqid());

        $customeUrl = $this->config['site_url'].'/wap.php?c=Ticket&a=weixin_back';
        $oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config['wechat_appid'].'&redirect_uri='.urlencode($customeUrl).'&response_type=code&scope=snsapi_userinfo&state='.$_SESSION['weixin']['state'].'#wechat_redirect';
        redirect($oauthUrl);
    }
    public function weixin_back(){
        $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('My/index',array("secret"=>$_SESSION['weixin']['key']));

        // if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $_SESSION['weixin']['state'])){
        if (isset($_GET['code'])){
            unset($_SESSION['weixin']['state']);
            import('ORG.Net.Http');
            $http = new Http();
            $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->config['wechat_appid'].'&secret='.$this->config['wechat_appsecret'].'&code='.$_GET['code'].'&grant_type=authorization_code');
            $jsonrt = json_decode($return,true);
            if($jsonrt['errcode']){
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
            }

            $return = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonrt['access_token'].'&openid='.$jsonrt['openid'].'&lang=zh_CN');
            $jsonrt = json_decode($return,true);
            if ($jsonrt['errcode']) {
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']),U('Login/index'));
            }

            /*优先使用 unionid 登录*/
            if(!empty($jsonrt['unionid'])){
                $this->autologin('union_id',$jsonrt['unionid'],$referer);
            }
            /*再次使用 openid 登录*/
            $this->autologin('openid',$jsonrt['openid'],$referer);

            /*注册用户*/
            $data_user = array(
                'openid'    => $jsonrt['openid'],
                'union_id'  => ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
                'nickname'  => $jsonrt['nickname'],
                'sex'       => $jsonrt['sex'],
                'province'  => $jsonrt['province'],
                'city'      => $jsonrt['city'],
                'avatar'    => $jsonrt['headimgurl'],
            );
            $_SESSION['weixin']['user'] = $data_user;
            $this->assign('referer',$referer);

            $this->display();
        }else{
            $this->error_tips('访问异常！请重新登录。',U('Login/index',array('referer'=>urlencode($referer))));
        }
    }

    public function weixin_bind_show(){
        $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('My/index',array("secret"=>$_SESSION['weixin']['key']));
        $this->assign("referer",$referer);
        $this->display();
    }

    protected function autologin($field,$value,$referer){
        $result = D('User')->autologin($field,$value);
        if(empty($result['error_code'])){
            $now_user = $result['user'];
            session('user',$now_user);
            //判断is_receive字段值是否为ticket
            if($now_user['is_receive']=="ticket"){
                $this->error_tips('您已经注册并参加过了无法再参加此次活动！',U('Login/index'));
            }else{
                 $data=array(
                        "now_money"=>($now_user['now_money']+100),
                        "is_receive"=>"ticket"
                        );
                $res=D('User')->where("uid=".$now_user['uid'])->setField($data);
                if($res){
                    D('User_money_list')->add_row($now_user['uid'],1,100,"领取100元现金券");
                    $this->success_tips('恭喜您成功获得了奖券!',$referer);
                }else{
                    $this->error_tips('领取奖券失败，请联系管理员!',U('Login/index'));
                }
            }
            exit;
        }else if($result['error_code'] && $result['error_code'] != 1001){
            $this->error_tips($result['msg'],U('Login/index'));
        }
    }


    public function weixin_bind(){
        if(empty($_SESSION['weixin']['user'])){
            $this->error('微信授权失效，请重新登录！');
        }
        $login_result = D('User')->checkin($_POST['phone'],$_POST['password']);
        if($login_result['error_code']){
            $this->error($login_result['msg']);
        }else{
            $now_user = $login_result['user'];
            $condition_user['uid'] = $now_user['uid'];
            $data_user['openid'] = $_SESSION['weixin']['user']['openid'];
            if($_SESSION['weixin']['user']['union_id']){
                $data_user['union_id']  = $_SESSION['weixin']['user']['union_id'];
            }
            if(empty($now_user['avatar'])){
                $data_user['avatar']    = $_SESSION['weixin']['user']['avatar'];
            }
            if(empty($now_user['sex'])){
                $data_user['sex']       = $_SESSION['weixin']['user']['sex'];
            }
            if(empty($now_user['province'])){
                $data_user['province']  = $_SESSION['weixin']['user']['province'];
            }
            if(empty($now_user['city'])){
                $data_user['city']      = $_SESSION['weixin']['user']['city'];
            }
            /****判断此用户是否在user_import表中***/
            $user_importDb=D('User_import');
            $user_import=$user_importDb->where(array('telphone'=>$condition_user['phone']))->find();
            if(!empty($user_import)){
             if($user_import['isuse']==0){
               $data_user['truename']=$user_import['ppname'];
               $data_user['qq']=$user_import['qq'];
               $data_user['email']=$user_import['email'];
               $data_user['level']=$user_import['level'];
               $data_user['score_count']=$user_import['integral'];
               $data_user['now_money']=$user_import['money'];
               $data_user['importid']=$user_import['id'];
             }
               $mer_id=$user_import['mer_id'];
               if($mer_id>0){
                  $merchant_user_relationDb=M('Merchant_user_relation');
                  $mwhere=array('openid'=>$data_user['openid'],'mer_id'=>$mer_id);
                  $mtmp=$merchant_user_relationDb->where($mwhere)->find();
                  if(empty($mtmp)){
                     $mwhere['dateline']=time();
                     $mwhere['from_merchant']=3;
                     $merchant_user_relationDb->add($mwhere);
                  }
               }
            }
            if(D('User')->where($condition_user)->data($data_user)->save()){
                unset($_SESSION['weixin']);
                session('user',$now_user);
                setcookie('login_name',$now_user['phone'],$_SERVER['REQUEST_TIME']+10000000,'/');
                if(!empty($user_import)){
                   $user_importDb->where(array('id'=>$user_import['id']))->save(array('isuse'=>1));
                }
                //判断是否已经参加过活动了
                if($now_user['is_receive']=="ticket"){
                    $this->success('此次活动您已经参加过了，谢谢参与！');
                }else{
                    $data=array(
                        "now_money"=>($now_user['now_money']+100),
                        "is_receive"=>"ticket"
                        );
                    $res=D('User')->where("uid=".$now_user['uid'])->setField($data);
                    $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('My/index',array("secret"=>$_SESSION['weixin']['key']));
                    if($res){
                    $this->success('领取奖券成功！谢谢参与！',$referer);
                    }else{
                    $this->error("领取失败，请联系管理员！",U('Login/index'));
                    }
                }
            }else{
                $this->error('绑定失败！请重试。',U('Login/index'));
            }
        }
    }
    public function weixin_bind_reg(){
        if(IS_POST){
            if(empty($_SESSION['weixin']['user'])){
                $this->error('微信授权失效，请重新登录！');
            }
        
            $condition_user['phone'] = $data_user['phone'] = trim($_POST['phone']);
            
            $database_user = D('User');
            if($database_user->field('`uid`')->where($condition_user)->find()){
                $this->error('手机号已存在');
            }
            
            if(empty($data_user['phone'])){
                $this->error('请输入手机号');
            }else if(empty($_POST['password'])){
                $this->error('请输入密码');
            }
            
            if(!preg_match('/^[0-9]{11}$/',$data_user['phone'])){
                $this->error('请输入有效的手机号');
            }

            $data_user['pwd'] = md5($_POST['password']);
            
            $data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
            
            
            $data_user['nickname'] = $_SESSION['weixin']['user']['nickname'];
            $data_user['openid'] = $_SESSION['weixin']['user']['openid'];
            if($_SESSION['weixin']['user']['union_id']){
                $data_user['union_id']  = $_SESSION['weixin']['user']['union_id'];
            }
            $data_user['avatar']    = $_SESSION['weixin']['user']['avatar'];
            $data_user['sex']       = $_SESSION['weixin']['user']['sex'];
            $data_user['province']  = $_SESSION['weixin']['user']['province'];
            $data_user['city']      = $_SESSION['weixin']['user']['city'];
            /****判断此用户是否在user_import表中***/
            $user_importDb=D('User_import');
            $user_import=$user_importDb->where(array('telphone'=>$condition_user['phone'],'isuse'=>'0'))->find();
            if(!empty($user_import)){
               $data_user['truename']=$user_import['ppname'];
               $data_user['qq']=$user_import['qq'];
               $data_user['email']=$user_import['email'];
               $data_user['level']=$user_import['level'];
               $data_user['score_count']=$user_import['integral'];
               $data_user['now_money']=$user_import['money'];
               $data_user['importid']=$user_import['id'];
               $mer_id=$user_import['mer_id'];
               if($mer_id>0){
                  $merchant_user_relationDb=M('Merchant_user_relation');
                  $mwhere=array('openid'=>$data_user['openid'],'mer_id'=>$mer_id);
                  $mtmp=$merchant_user_relationDb->where($mwhere)->find();
                  if(empty($mtmp)){
                     $mwhere['dateline']=time();
                     $mwhere['from_merchant']=3;
                     $merchant_user_relationDb->add($mwhere);
                  }
               }
            }
            if($uid = $database_user->data($data_user)->add()){
                $session['uid'] = $uid;
                $session['phone'] = $data_user['phone'];
                session('user',$session);
                //注册成功后给奖券
                 $data=array(
                        "now_money"=>100,
                        "is_receive"=>"ticket"
                        );
                $res=$database_user->where("uid=".$uid)->setField($data);
                setcookie('login_name',$session['phone'],$_SERVER['REQUEST_TIME']+1000000,'/');
                if(!empty($user_import)){
                   $user_importDb->where(array('id'=>$user_import['id']))->save(array('isuse'=>1));
                }
                $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('My/index',array("secret"=>$_SESSION['weixin']['key']));
                if($res){
                $this->success('注册并领取奖券成功！谢谢参与！',$referer);
                }else{
                    $this->error("领取失败，请联系管理员！",U('Login/index'));
                }
            }else{
                $this->error('注册失败！请重试！',U('Login/index'));
            }
        }
    }
    public function weixin_nobind(){
        if(empty($_SESSION['weixin']['user'])){
            $this->error('微信授权失效，请重新登录！');
        }
        $reg_result = D('User')->autoreg($_SESSION['weixin']['user']);
        if($reg_result['error_code']){
            $this->error_tips($reg_result['msg']);
        }else{  
            $login_result = D('User')->autologin('openid',$_SESSION['weixin']['user']['openid']);
            if($login_result['error_code']){
                $this->error_tips($login_result['msg'],U('Login/index'));
            }else{
                $now_user = $login_result['user'];
                //根据获取的now_user增加奖券
                //注册成功后给奖券
                $data=array(
                        "now_money"=>100,
                        "is_receive"=>"ticket"
                        );
                $res=D('User')->where("uid=".$now_user['uid'])->setField($data);
                session('user',$now_user);
                $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : U('My/index',array("secret"=>$_SESSION['weixin']['key']));
                
                unset($_SESSION['weixin']);
                if($res){
                $this->success_tips('登录成功，并成功领取奖券！',$referer);
                }else{
                $this->error_tips('登录成功，但领取奖券失败！',$referer);
                }
                exit;
            }
        }
    }
}
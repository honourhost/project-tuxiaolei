<?php

class BaseAction extends CommonAction
{
    public $now_user;

    protected function _initialize()
    {
        parent::_initialize();

        if (empty($this->user_session)) {
			redirect(u('Index/Login/index', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!(true == empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
            exit();
        }

		$now_user = d('User')->get_user($this->user_session['uid']);
        
        if (empty($now_user)) {
			$this->error_tips('未获取到您的帐号信息，请重试！');
        }

		$now_user['now_money'] = floatval($now_user['now_money']);
         //如果头像字段存在,证明为后期上传的则获取真实地址
        if(strstr($now_user['avatar'],",")) {
            $avatar_image_class = new avatar_image();
            $return= $avatar_image_class->get_image_by_path($now_user['avatar'], C('config.site_url'));
            $now_user['avatar']=$return['image'];
        }
        $this->now_user = $now_user;
		$this->assign('now_user', $now_user);
    }

    public function _empty()
    {
		$this->error('Fuck ! 你搞错了。');
    }
}


?>

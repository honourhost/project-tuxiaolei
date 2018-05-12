<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/29
 * Time: 17:21
 */
class ExpressNewAction extends BaseAction
{

    protected  $base="https://sp0.baidu.com/9_Q4sjW91Qh3otqbppnN2DJv/pae/channel/data/asyncqury?appid=4001&com=ems&nu=9630067620008&vcode=&token=&_=1503395099517";

    public function query(){

      $result=$this->getHtml($this->base);
      echo  $result;
    }

    function getHtml($url, $post = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Remote Address: 127.0.0.1:8888','Referrer Policy:no-referrer-when-downgrade'));

        if(!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
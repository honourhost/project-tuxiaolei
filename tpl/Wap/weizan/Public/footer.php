		<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
        <!--刘畅 占位-->
        <div style="height: 17px;overflow: hidden;display: block;"></div>
	    <footer class="footermenu">
		    <ul>
                <li>
		            <a <if condition="MODULE_NAME eq 'Home'">class="active"</if> href="{pigcms{:U('Home/index')}">
		            <img src="{pigcms{$static_path}images/liuchang/home<if condition="MODULE_NAME eq 'Home'">_on</if>.png">
		            <p>首页</p>
		            </a>
		        </li>
                <li>
		            <a <if condition="MODULE_NAME eq 'Group'">class="active"</if> href="{pigcms{:U('Group/index')}">
		            <img src="{pigcms{$static_path}images/liuchang/gou<if condition="MODULE_NAME eq 'Group'">_on</if>.png">
		            <p>{pigcms{$config.group_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a href="javascript:;" onclick="wx_yuyinsosuo()">
                        <img src="{pigcms{$static_path}images/liuchang/yuyin.png" id="maike" style="width: 40px;height:40px;margin-top:4px;">
		            </a>
		        </li>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('Meal_list','Meal'))">class="active"</if> href="{pigcms{:U('Meal_list/index')}">
		            <img src="{pigcms{$static_path}images/liuchang/kuai<if condition="in_array(MODULE_NAME,array('Meal_list','Meal'))">_on</if>.png">
		            <p>{pigcms{$config.meal_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('My','Login'))">class="active"</if> href="{pigcms{:U('My/index')}">
		            <img src="{pigcms{$static_path}images/liuchang/user<if condition="in_array(MODULE_NAME,array('My','Login'))">_on</if>.png">
		            <p>我的</p>
		            </a>
		        </li>
		    </ul>
		</footer>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
        
{pigcms{$shareScript}
<script>
//刘畅 - 新增 微信功能，配置

  
  //语音按钮时间次数 初化为 -1
  var yuyin_jc = -1;
  
  //语音计次时间句柄
  var yuyin_jc_j="";

  //语音按钮图片切换函数
  function maike_img(body)
  {
    //路径和后缀和分割
    img="{pigcms{$static_path}images/liuchang/yuyin";
    hou=".png";
    fen=body ? "_" : "";
    
    
    //组合
    img=img+fen+body+hou;
    
    //语音按钮切换
    $("#maike").attr("src",img);;
  }
  
  //语音等待倒计时
  function maike_js()
  {
    if(yuyin_jc > 0)
    {
        //切换麦克
        maike_img(yuyin_jc);
        
        //减去时间
        yuyin_jc = yuyin_jc-1;
        
        //下一次开始
        yuyin_jc_j=setTimeout("maike_js()",1000);
    }
    else
    {   
        //开始识别
        wx_yuyinsosuo();
    }
  }
  
  //开始语音搜索
  function wx_yuyinsosuo()
  {
    if(yuyin_jc == -1)
    {
        //从几秒开始倒
        yuyin_jc=3;
        
        ts("开始说出想要的东东！");
        
        //开始计时
        maike_js();
        
        //开始录音
        wx.startRecord();
    }
    else
    {
        wx_yuyinsosuo_k();
    }
  }

  
  //语音识别并跳转搜索
  function wx_yuyinsosuo_k()
  {
    //标识
    yuyin_jc = -1;
        
    //等待识别
    maike_img(".");
    
    //停止计时
    clearTimeout(yuyin_jc_j);
    
    wx.stopRecord(
    {
        success: function (res) 
        {
            wx.translateVoice(
            {
               localId: res.localId, // 需要识别的音频的本地Id，由录音相关接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function (res)
                {
                    //切换原来的图片
                    maike_img("");
                    
                    // 语音识别的结果
                    body=res.translateResult;
                    
                    //替换所有标点
                    body=body.replace(/[\!|\,|\.|\。|\，|\！|\？|\?]/g,"");  
                    
                    //html跳转
                    window.location.href="/wap.php?g=Wap&c=Search&a=group&w="+body;
                }
            });
        }
    });
  }
  
  //调用微信扫一扫
  function wx_saoyisao()
  {
    wx.scanQRCode(
    {
        needResult: 0 // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
    });
  }
  
  function ts(body)
  {
    $("body").append("<div class='ts'><p>"+body+"</p></div>");
    setTimeout("$('.ts').remove()",2000);
  }
</script>

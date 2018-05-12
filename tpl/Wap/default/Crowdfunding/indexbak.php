<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<meta charset="utf-8" />
		<title>众筹-主页</title>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/css.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/swiper.min.css"/>
	</head>
	<body>
		<div class="wpc-zc">
			<div class="swiper-container">
		        <div class="swiper-wrapper">
                    <volist name="advers" id="adver">

                            <div class="swiper-slide">
                                <a href="{pigcms{$adver.url}">
                                <img src="http://www.xiaonongding.com/upload/adver/{pigcms{$adver.pic}" />
                                </a>
                            </div>


                    </volist>


		        </div>
		        <!-- Add Pagination -->
		        <div class="swiper-pagination"></div>
		    </div>
		    <div class="wpc-nav">
		    	<ul>
		    		<li class="on">
		    			<a href="#">最新</a>
		    		</li>

		    	</ul>
		    </div>
		    <!-- 众筹列表 -->
		    <div class="wpc-list">
		    	<ul>
                    <volist name="crowdfundings" id="crowdfunding">
                        <a href="{pigcms{:U('Crowdfunding/detail',array('crowdid'=>$crowdfunding['crowd_id']))}">


                        <li>
                            <h3>
		    				<span>
		    					<img src="{pigcms{$crowdfunding.merchant.person_image}" />

		    				</span>
                                发起人·{pigcms{$crowdfunding.merchant.name}
                            </h3>
                            <div class="list-img" style="background-image: url({pigcms{$crowdfunding.webpic});">
                                <?php if($crowdfunding['progress']==0){?>
                                <i>进行中</i>
                                <?php } else { ?>
                                <?php }?>
                            </div>
                            <h4>{pigcms{$crowdfunding.title}</h4>
                            <p>
                                {pigcms{$crowdfunding.digest}
                            </p>
                            <div class="wpc-icon">
		    				<span>
		    					<i><img src="{pigcms{$static_path}images/see.png" /></i>{pigcms{$crowdfunding.hit}
		    				</span>

                            </div>
                            <div class="wpc-user" style="display: none;">
		    				<span>
		    					<i><img src="http://www.xiaonongding.com/xnd.png" /></i>
		    					<p>
		    						客房使用代金券需要补多少差价
		    					</p>
		    				</span>
                                <span>
		    					<i><img src="http://www.xiaonongding.com/xnd.png" /></i>
		    					<p>
		    						客房使用代金券需要补多少差价
		    					</p>
		    				</span>
                            </div>
                        </li>
                        </a>
                    </volist>


		    	</ul>
		    </div>
		</div>
	</body>
	<script src="{pigcms{$static_path}js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        spaceBetween: 0,
        loop:true
    });
    </script>
</body>
</html>

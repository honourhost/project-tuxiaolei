<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no"/>
    <title>Family Fun Run Festival</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base2.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style2.css"/>
</head>
<body>
<!-- banner图+小农的logo -->

<header class="max-width">
    <div class="header-banner">
        <img src="{pigcms{$static_path}img/header-banner.jpg"/>
    </div>
    <div class="xnd-logo">
        <img src="{pigcms{$static_path}img/logo.jpg"/>
        <h3>
			<span>Media Partner</span>
			<p>活动媒体合作伙伴: 小农丁</p>
		</h3>
    </div>
</header>
<!-- end -->

<!-- 活动介绍 -->
<form method="post"  enctype="multipart/form-data" action="{pigcms{:U('Third/meiyaaction')}">
<div class="max-width">
    <div class="content-cen">
        <div class="activity-title">
            <h2>Family Fun Run Festival 2017</h2>
        </div>
        <div class="activity-banner">
            <img src="{pigcms{$static_path}img/xc-img.jpg"/>
        </div>
        <div class="activity-news">
            <ul class="news-img">
                <li>
                    <img src="{pigcms{$static_path}img/news-img.jpg"/>
                </li>
                <li>
                    <img src="{pigcms{$static_path}img/news-img2.jpg"/>
                </li>
                <div class="clear"></div>
            </ul>
            <div class="activity-en">
                <p>The exciting tradition continues, as QAIS hosts its annual Family Fun Run on May 20th at the Hyatt
                    Regency Hotel from 10am-1pm.</p>
                <p>This is the perfect opportunity to enjoy the beauty of the sea side, while listening to energetic
                    live music from QAIS’s top musicians and bands. Family and friends can participate in the race along
                    the boardwalk, take part in games, activities, and raffle drawings for wonderful prizes. </p>
                <p> This event promises to be a fun-filled day, perfect for the whole family! So come one, come all, and
                    join us in celebrating the gorgeous spring weather and one another. See you there.</p>
            </div>
            <div class="activity-china">
                <p>作为深受欢迎的传统，一年一度的青岛美亚国际学校欢乐家庭跑将于5月20日上午10:00至下午1:00在凯悦酒店户外草坪举行。</p>
                <p>
                    这是享受春光和周末的绝佳方式：在青岛最美的海边欣赏青岛美亚国际学校极具才华的音乐人及乐队带来的活力四射的现场音乐同时，各国的家庭和他们的朋友可以参加沿木栈道进行的健跑，做各类游戏、活动、参与丰厚奖品的抽奖环节。</p>
                <p>这个活动将会充满乐趣，特别适合全家人一起参与！所以快来加入吧，与我们一起庆祝春天的灿烂与美好。期待与您相见。</p>

            </div>
            <div class="form-my">
                <ul>
                    <li>
                        <label>Your Name<span>您的姓名</span></label>
                        <input type="text"  name="username" />
                    </li>
                    <li>
                        <label>Phone<span>电话号码</span></label>
                        <input type="text" name="phone"/>
                    </li>
                    <li>
                        <label>Email<span>电子邮件</span></label>
                        <input type="text" name="email"/>
                    </li>
                    <li>
                        <label>Preferred language<br/><span>倾向的语言：</span></label>
                        <select name="tendlanguage">
                            <option value='' disabled selected style='display:none;'>Please Choose 请选择</option>
                            <option value="0">English 英文</option>
                            <option value="1">Chinese 中文</option>
                        </select>
                    </li>
                    <li>
                        <label>
                            How do you<br/>
                            (the contact person)<br/>
                            know QAIS?<br/>
                            <span>你从哪里获知QAIS?：</span></label>
                        <select name="whereknow">
                            <option value='' disabled selected style='display:none;'>Please Choose 请选择</option>
                            <option value="0">My kids go to QAIS. 我的孩子在青岛美亚国际学校就读</option>
                            <option value="1">I'm a staff member 我是青岛美亚国际学校老师</option>
                            <option value="2">I'm a guest 我是来访家长</option>
                        </select>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="xnd-banenr">
        <img src="{pigcms{$static_path}img/xnd-banner.jpg"/>
    </div>
    <div class="content-cen">
        <div class="team">
            <div class="team-title-en">
                <h3>Who is In Your Party?</h3>
                <p>
                    Please tell us a little bit about your group!<br/>
                    (please make sure you add everyone by clicking the +sign)
                </p>
            </div>
            <div class="team-title-china">
                <h3>你将会带谁?</h3>
                <p>
                    请告诉我们更多关于你们团队的信息。<br/>
                    (请确认已经通过点击+按钮添加每一个人)
                </p>
            </div>
            <!-- add -->
            <div class="form-copy">
                <div class="form-my">
                    <ul>
                        <li>
                            <label>Name<span>名字</span></label>
                            <input type="text"  name="user_0[]"/>
                        </li>
                        <li>
                            <label>Age<span>年龄</span></label>
                            <input type="text"  name="user_0[]"/>
                        </li>
                        <li>
                            <label>Nationality<span>国籍</span></label>
                            <input type="text" name="user_0[]"/>
                        </li>
                        <li>
                            <label>
                                T-shirt Size<span>尺寸</span><br/>
                                (XS,S,M,L,XL,XXL,XXXL)
                            </label>
                            <input type="text" name="user_0[]"/>
                        </li>
                        <li>
                            <label>Height<span>身高</span>(cm)</label>
                            <input type="text" name="user_0[]"/>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="submit">
                <input type="submit" class="sub" value="Submit">
            </div>
            <div class="add-btn">
                <img src="{pigcms{$static_path}img/icon-add.png"/>
            </div>

        </div>
        <div class="con-img">
            <img src="{pigcms{$static_path}img/con-img.jpg"/>
            <img src="{pigcms{$static_path}img/con-img2.jpg"/>
            <img src="{pigcms{$static_path}img/con-img3.jpg"/>
        </div>
    </div>
    <!-- 小农丁品牌 -->
    <div class="xnd">
        <div class="xnd-p-logo">
            <img src="{pigcms{$static_path}img/logo2.jpg"/>
        </div>
        <div class="xnd-pinpai">
            <img src="{pigcms{$static_path}img/xnd-hb.jpg"/>
        </div>
        <div class="xnd-ma">
            <img src="{pigcms{$static_path}img/xnd-ma.jpg"/>
            <p>
                长按关注小农丁<br/>享受最有品的农产品
            </p>
        </div>
        <div class="clear"></div>
    </div>

    <footer>
        <div class="footer-tit">
            <span></span>
            <h3>CONTACT QAIS</h3>
        </div>
        <div class="footer-p">
            <div class="content-cen">
                <p>info@QingdaoAmerasia.org</p>
                <p>(+86 532)8388-9900</p>
                <p>68 Shandongtou Lu,</p>
                <p>Laoshan District,Qingdao,</p>
                <p>China 266061</p>
                <p style="margin-top: 10px;">崂山区山东头68号</p>
                <p>(青医附院东院后面，<br/>国信体育场南门向南二三百米处)</p>
                <div class="footer-ditu">
                    <img src="{pigcms{$static_path}img/ditu.jpg"/>
                </div>
            </div>
        </div>
        <p class="footer-copy">&copy;2015 Qingdao Amerasia International School</p>
    </footer>
</div>
    <input type="hidden" name="userindex" id="userindex" value="0">
</form>


</body>
<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function () {
        $('.add-btn').click(function () {
            var indexnow=$("#userindex").val();
            $("#userindex").val(parseInt(indexnow)+1);
            var tag="user_"+(parseInt(indexnow)+1);
            $('.form-copy').append("<div class=\'form-my form-line\'><ul><li><label>Name<span>名字</span></label><input type=text name='"+tag+"[]'/></li><li><label>Age<span>年龄</span></label><input type=text name='"+tag+"[]'/></li><li><label>Nationality<span>国籍</span></label><input type=text name='"+tag+"[]'/></li><li><label>T-shirt Size<span>尺寸</span><br />(XS,S,M,L,XL,XXL,XXXL)</label><input type=text name='"+tag+"[]'/></li><li><label>Height<span>身高</span>(cm)</label><input type=text name='"+tag+"[]'/></li></ul><div class=clear></div></div>");
        });
    })
</script>
</html>
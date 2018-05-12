<if condition="empty($no_footer)">
    <footer class="footerMenu wap">
        <ul>
            <li>
                <a class="active" href="/wap.php?g=Wap&c=Home&a=index"><em class="home"></em><p>首页</p></a>
            </li>
            <li>
                <a  href="/wap.php?g=Wap&c=Group&a=index"><em class="group"></em><p>微团</p></a>
            </li>

            <li>
                <a  href="/wap.php?g=Wap&c=Meal_list&a=index"><em class="store"></em><p>微店</p></a>
            </li>
            <li>
                <a  href="/wap.php?g=Wap&c=My&a=index"><em class="my"></em><p>我的</p></a>
            </li>
        </ul>
    </footer>
</if>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('Meal_list','Meal'))">class="active"</if> href="{pigcms{:U('Meal_list/index')}">
					<em class="meal"></em>
		            <p>{pigcms{$config.meal_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('My','Login'))">class="active"</if> href="{pigcms{:U('My/index')}">
					<em class="my"></em>
		            <p>我的</p>
		            </a>
		        </li>
		    </ul>
		</footer>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>



        <?php
        echo '<br/>SESSION输出：<br/>';
        print_r($_SESSION);
        echo '<br/>COOKIE输出:  <br/>';
        print_r($_COOKIE);
        echo '<br/>';

        print_r($)


        ?>
        
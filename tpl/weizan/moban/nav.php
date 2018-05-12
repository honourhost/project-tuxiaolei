
<div class="body">
	<div class="menu cf">
		<div class="menu_left hide">
			<div class="menu_left_top">
				全部分类
			</div>
			<div class="list">
				<ul>
					<volist name="all_category_list" id="vo" key="k">
						<li>
							<div class="li_top cf">
								<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
								<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
							</div>
							<if condition="$vo['cat_count'] gt 1">
								<div class="li_bottom">
									<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
										<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
									</volist>
								</div>
								<div class="list_txt">
									<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
									<volist name="vo['category_list']" id="voo" key="j">
										<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
									</volist>
								</div>
							</if>
						</li>
					</volist>
				</ul>
			</div>
		</div>
		<div class="menu_right">
			<div class="menu_right_top">
				<ul>

                <pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
				    <li class="ctur">
					   <a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
					</li>
				</pigcms:slider>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="abs footer_lower chrome_light">
		<a href="<?php echo get_bloginfo('rss2_url');?>" class="float_left button">
			RSS
		</a>
		<a href="http://twitter.com/dhezign" class="icon icon_bird float_right"></a>
		<a href="<?php bloginfo('url');?>/wpipadoff">View full site</a>
	</div>
</div>
<div id="sidebar" class="abs">
	<span id="nav_arrow"></span>
	<div class="abs header_upper chrome_light">
		&nbsp;
	</div>
	<form action="<?php bloginfo('url'); ?>" class="abs header_lower chrome_light">
		<input type="secarch" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search..." />
	</form>
	<div id="sidebar_content" class="abs">
		<div id="sidebar_content_inner">
			<ul id="sidebar_menu">
				<li id="sidebar_menu_home" class="active">
					<a href="<?php bloginfo('url');?>"><span class="abs"></span>Home</a>
				</li>
				<?php wp_list_categories('title_li=');?>
				<li>
				    <a href="<?php bloginfo('url');?>/kontribusi/">Contribute!</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="abs footer_lower chrome_light">
		<span class="float_right gutter_right">iPad theme based on <a href="http://host.sonspring.com/slablet/" target="_blank">slablet</a> layout</span>
	</div>
</div>
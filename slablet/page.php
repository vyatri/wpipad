<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<div id="main_content" class="abs">
		<div id="main_content_inner">
			<h1>
				<?php the_title();?>
			</h1>
			<p>
				<?php the_content();?>
			</p>
		</div>
	</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
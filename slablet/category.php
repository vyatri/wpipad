<?php get_header(); ?>
<div id="main_content" class="abs">
		<div id="main_content_inner">
			<h1>
				<?php single_cat_title(); ?>
			</h1>
			<table class="data">
				<thead>
					<tr>
						<th>
						    Posts in this category 
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				 $q = 'posts_per_page=-1&category_name='.$wp_query->query_vars['category_name'];
				 query_posts($q);
				if (have_posts()) : while (have_posts()) : the_post();?>
					<tr>
						<td>
							<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
						</td>
					</tr>
				<?php endwhile; endif; ?>
				</tbody>
			</table>
			
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
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
				<?php $recentposts = get_posts('numberposts=-1');
                    foreach ($recentposts as $post) :
                        setup_postdata($post); ?>
					<tr>
						<td>
							<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
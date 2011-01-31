<?php get_header(); ?>
<div id="main_content" class="abs">
		<div id="main_content_inner">
			<table class="data">
				<thead>
					<tr>
						<th>
						    Results
						</th>
					</tr>
				</thead>
				<tbody>
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
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
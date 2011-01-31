<?php get_header(); ?>
<div id="main_content" class="abs">
		<div id="main_content_inner">
			<table class="data">
				<thead>
					<tr>
						<th>
						    Artikel terbaru
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
                    $recentposts = get_posts('numberposts=10');
                    foreach ($recentposts as $post) :
                        setup_postdata($post); ?>
					<tr>
						<td>
							<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
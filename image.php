<?php get_header(); ?>

	<div id="content">

		<div class="grid_4">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>

				<div id="post-<?php the_ID(); ?>">
					<h2><a href="<?php echo get_permalink( $post->post_parent ); ?>" rev="attachment"><?php echo get_the_title( $post->post_parent ); ?></a> &raquo; <?php the_title(); ?></h2>

					<p><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a></p>

					<div>

						<?php
						if ( ! empty( $post->post_excerpt ) ) {
							the_excerpt();} // the caption
						?>
						<?php the_content(); // the description ?>

						<div class="nav-image">
							<div class="prev-link"><?php previous_image_link(); ?></div>
							<div class="next-link"><?php next_image_link(); ?></div>
						</div>

						<div class="clear"></div>

					</div>

					<div>
						<?php
							wp_link_pages(
								array(
									'before'         => '<p><strong>Pages:</strong> ',
									'after'          => '</p>',
									'next_or_number' => 'number',
								)
							);

											the_tags( '<p>Tags: ', ', ', '</p>' );
						?>

						<p><?php edit_post_link( 'Edit this entry', '', '.' ); ?></p>
					</div>

				</div><!-- end #post-xxx -->

				<div id="comments">
									<?php comments_template(); ?>
				</div>

				<div class="nav-image-post">
					<p><?php previous_post_link(); ?> &bull; <?php next_post_link(); ?></p>
				</div>

							<?php endwhile; else : ?>
				<p>Sorry, no posts matched your criteria.</p>
			<?php endif; ?>

		</div><!-- end .grid_4 -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>

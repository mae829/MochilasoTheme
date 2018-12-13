<?php
/**
 * The template for displaying all single gallery posts
 *
 * @package mochilaso
 */

get_header();
?>
		<div id="content">
			<div class="grid_4">

				<h2 class="page-title"><?php the_title(); ?></h2>

				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();

						$args      = array(
							'post_parent'    => get_the_ID(),
							'post_type'      => 'attachment',
							'numberposts'    => -1,
							'post_status'    => null,
							'post_mime_type' => 'image',
							'offset'         => 0,
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
						);
						$images    = get_children( $args );
						$counter   = 0;
						$theme_url = get_bloginfo( 'template_url' );

						if ( $images ) {
							echo '<ul class="single-gallery">';

							foreach ( $images as $image ) {
								$img_thumb     = wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag.
								$img_med       = wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag.
								$img_large     = wp_get_attachment_image_src( $image->ID, 'large' ); // large image url.
								$img_title     = apply_filters( 'the_title', $image->post_title );
								$img_permalink = get_permalink( $image->ID );
								?>
								<li><a href="<?php echo esc_url( $img_permalink ); ?>" rel="prettyPhoto"><?php echo wp_kses_post( $img_thumb ); ?></a></li>
								<?php
							}

							echo '</ul>';

						} else {
							echo '<p>No images are in this gallery</p>';
						}

					endwhile;
				else :
					?>
					<p>An error occured, please contact us and let us know.</p>
				<?php endif; ?>

			</div><!--end grid_4-->

<?php get_sidebar(); ?>

			<div class="clear"></div>
		</div><!--END CONTENT-->

<?php get_footer(); ?>

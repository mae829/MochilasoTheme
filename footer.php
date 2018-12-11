<?php
/**
 * The template for displaying the footer
 *
 * @package mochilaso
 */

?>
			</div><!--END WRAPPER-->
		</div><!--END MAIN-->
		<footer>
			<div class="wrapper">
				<div class="grid_1">
					<h2>Archives</h2>
					<ul>
						<?php wp_get_archives( 'type=monthly' ); ?>
					</ul>
					<h2>Suscribe</h2>
					<ul>
						<li><a href="<?php bloginfo( 'rss2_url' ); ?>">Entries (RSS)</a></li>
						<li><a href="<?php bloginfo( 'comments_rss2_url' ); ?>">Comments (RSS)</a></li>
					</ul>
				</div>

				<div class="grid_3">
					<h2>Latest Images</h2>

				<?php
				$gallery_images = new WP_Query( 'post_type=gallery&post_status=publish&showposts=1' );

				if ( $gallery_images->have_posts() ) :
					?>
					<ul class="latest-images">
					<?php
					while ( $gallery_images->have_posts() ) :
						$gallery_images->the_post();

						$args      = array(
							'post_parent'    => get_the_ID(),
							'post_type'      => 'attachment',
							'numberposts'    => 8, // show all.
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
							foreach ( $images as $image ) {
								$img_thumb     = wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag.
								$img_med       = wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag.
								$img_large     = wp_get_attachment_image_src( $image->ID, 'large' ); // large image url.
								$img_title     = apply_filters( 'the_title', $image->post_title );
								$img_permalink = get_permalink( $image->ID );

								echo "<li><a href=\"$img_permalink\" rel=\"prettyPhoto\">
										$img_thumb
									</a></li>";
							}
						} else {
							echo '<p>No images are in this gallery</p>';
						}
						endwhile;
					?>
					</ul>
				<?php endif; ?>

				</div><!--END grid_3-->

				<div class="grid_1">
					<h2>Search</h2>
					<?php get_search_form(); ?>

					<h1><a href="<?php echo get_option( 'home' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<p>
						Los Topete are <a href="http://www.mochilaso.com/author/danny/">Daniel Topete Romero</a> &amp; <a href="http://www.mochilaso.com/author/andres/">Andres Luken Topete</a>.
						This site serves as their online diary for their travels/adventures through South America.
						Purposely built as a form to keep in touch with family, friends, you.
					</p>
				</div>
				<div class="clear"></div>
				<p>
					&copy;<?php echo date( 'Y' ) . ' '; ?>Mochilaso.com<br />
					Designed/Developed by <a href="http://bleucellar.com/">Miguel "Mikey" Estrada</a>.<br />
					Created with <a href="http://wordpress.org/">WordPress</a>, <a href="http://digwp.com/2010/02/blank-wordpress-theme/">DigWP Blank theme</a>, <a href="http://www.google.com/webfonts">Google web fonts</a>, and <a href="http://jquery.com/">jQuery</a>.
				</p>
			</div>
		</footer><!--END FOOTER-->
		<?php wp_footer(); ?>
	</body>
</html>

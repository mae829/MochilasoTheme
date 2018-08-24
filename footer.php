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
					global $wp_query;
					$wp_query = new WP_Query('post_type=gallery&post_status=publish&showposts=1');
					if ( $wp_query->have_posts() ) :
				?>
					<ul class="latest-images">
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<?php
						$args = array(
							'post_parent'		=> get_the_ID(),
							'post_type'			=> 'attachment',
							'numberposts'		=> 8, // show all
							'post_status'		=> null,
							'post_mime_type'	=> 'image',
							'offset'			=> 0,
							'orderby'			=> 'menu_order',
							'order'				=> 'ASC'
						);
						$images		= get_children( $args );
						$counter	= 0;
						$theme_url	= get_bloginfo( 'template_url' );

						if ( $images ) {
							foreach ( $images as $image ) {
								$imgThumb		= wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag
								$imgMed			= wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag
								$imageLarge		= wp_get_attachment_image_src( $image->ID, 'large' ); // large image url
								$imgTitle		= apply_filters( 'the_title', $image->post_title );
								$imgPermalink	= get_permalink( $image->ID );

								echo "<li><a href=\"$imgPermalink\" rel=\"prettyPhoto\">
											$imgThumb
									  </a></li>";
							}
						} else {
							echo '<p>No images are in this gallery</p>';
						}
						?>

					<?php endwhile; ?>
					</ul>
				<?php endif; ?>

				</div><!--END grid_3-->

				<div class="grid_1">
					<h2>Search</h2>
					<?php get_search_form(); ?>

					<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
					<p>
						Los Topete are <a href="http://www.mochilaso.com/author/danny/">Daniel Topete Romero</a> &amp; <a href="http://www.mochilaso.com/author/andres/">Andres Luken Topete</a>.
						This site serves as their online diary for their travels/adventures through South America.
						Purposely built as a form to keep in touch with family, friends, you.
					</p>
				</div>
				<div class="clear"></div>
				<p>
					&copy;<?php echo date('Y'); echo ' '; ?>Mochilaso.com<br />
					Designed/Developed by <a href="http://bleucellar.com/">Miguel "Mikey" Estrada</a>.<br />
					Created with <a href="http://wordpress.org/">WordPress</a>, <a href="http://digwp.com/2010/02/blank-wordpress-theme/">DigWP Blank theme</a>, <a href="http://www.google.com/webfonts">Google web fonts</a>, and <a href="http://jquery.com/">jQuery</a>.
				</p>
			</div>
		</footer><!--END FOOTER-->
		<?php wp_footer(); ?>
	</body>
</html>

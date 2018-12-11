<?php get_header(); ?>
		<div id="content">
			<div class="grid_4">
			
				<h2 class="page-title"><?php the_title(); ?></h2>
		
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
				<!--<p><em>Posted by:</em> <?php the_author(); ?> <?php comments_popup_link( 'No Comments', '1 Comment', '% Comments', 'comments-link', '' ); ?></p>-->
						<?php
						$args                  = array(
							'post_parent'    => get_the_ID(),
							'post_type'      => 'attachment',
							'numberposts'    => -1, // show all
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
											$imgThumb     = wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag
											$imgMed       = wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag
											$imageLarge   = wp_get_attachment_image_src( $image->ID, 'large' ); // large image url
											$imgTitle     = apply_filters( 'the_title', $image->post_title );
											$imgPermalink = get_permalink( $image->ID );


											echo "<li>
								<a href=\"$imgPermalink\" rel=\"prettyPhoto\">
									$imgThumb
								</a>
							  </li>";
							}

							echo '</ul>';

						} else {
							echo '<p>No images are in this gallery</p>';
						}

						?>
				<?php endwhile; ?>
					<?php // my_paginate_links(); ?>
				<?php else : ?>
				<p>An error occured, please contact us and let us know.</p>
				<?php endif; ?>
				
			</div><!--end grid_4-->
			
<?php get_sidebar(); ?>	 
			<div class="clear"></div>
			</div><!--END CONTENT-->

<?php get_footer(); ?>

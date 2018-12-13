<?php
/**
 * Template Name: Tutorial
 *
 * Template for displaying a tutorial for use by authors.
 *
 * @package mochilaso
 */

get_header();
?>

	<div id="content">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				the_title();

				$args = array(
					'post_parent'    => get_the_ID(),
					'post_type'      => 'attachment',
					'numberposts'    => -1, // show all.
					'post_status'    => null,
					'post_mime_type' => 'image',
					'offset'         => 0,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				);

				$images = get_children( $args );

				$counter = 0;

				$theme_url = get_bloginfo( 'template_url' );

				if ( $images ) {
					foreach ( $images as $image ) {
						$img_thumb     = wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag.
						$img_med       = wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag.
						$image_large   = wp_get_attachment_image_src( $image->ID, 'large' ); // large image url.
						$img_full      = wp_get_attachment_image_src( $image->ID, 'full' ); // full size image url.
						$img_permalink = get_permalink( $image->ID );

						$counter++;

						echo '<h3>Step ' . esc_html( $counter ) . '</h3>' . "\n";

						echo '<img src="' . esc_url( $img_full[0] ) . '" alt="Step ' . esc_attr( $counter ) . '" />';
					}
				} else {
					echo '<p>No images are in this tutorial</p>';
				}

				the_content();

			endwhile;
		endif;
		?>

	</div>

<?php get_footer(); ?>

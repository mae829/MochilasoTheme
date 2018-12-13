<?php
/**
 * The sidebar containing the imagees area
 *
 * @package mochilaso
 */

?>
<div id="sidebar" class="grid_1">

	<div class="box">
		<h2>Latest Entries</h2>
		<ul>
		<?php
		wp_get_archives(
			array(
				'type'            => 'postbypost', // or daily, weekly, monthly, yearly.
				'limit'           => 5, // maximum number shown.
				'format'          => 'html', // or select (dropdown), link, or custom.
				'show_post_count' => false, // show number of posts per link.
				'echo'            => 1, // display results or return array.
			)
		);
		?>
		</ul>

		<h2>Locations</h2>
		<?php
		$tags = get_tags();
		if ( $tags ) {
			echo '<ul>';
			foreach ( $tags as $tag ) {
				echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' . esc_attr( 'View all posts in ' . $tag->name ) . '" >' . esc_html( $tag->name ) . '</a> </li>';
			}
			echo '</ul>';
		}
		?>

		<h2>Random Image</h2>

		<?php
		$gallery_args = array(
			'showposts' => 1,
			'post_type' => 'gallery',
			'orderby'   => 'rand',
		);
		$the_gallery  = new WP_Query( $gallery_args );

		while ( $the_gallery->have_posts() ) :
			$the_gallery->the_post();

			$images_args = array(
				'post_parent'    => get_the_ID(),
				'post_type'      => 'attachment',
				'numberposts'    => 1,
				'post_status'    => null,
				'post_mime_type' => 'image',
				'orderby'        => 'rand',
			);
			$images      = get_children( $images_args );
			$theme_url   = get_bloginfo( 'template_url' );

			if ( $images ) {

				foreach ( $images as $image ) {
					$img_thumb     = wp_get_attachment_image( $image->ID, 'thumbnail' ); // thumbnail full img tag.
					$img_permalink = get_permalink( $image->ID );
					echo '<a href="' . esc_url( $img_permalink ) . '">' . wp_kses_post( $img_thumb ) . '</a>';
				}
			} else {
				echo '<p>No images are in this gallery</p>';
			}

		endwhile;
		?>

	</div><!--end .box-->

</div><!-- end #sidebar.grid_1 -->

<?php
/**
 * The sidebar containing the main widget area
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
				echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" title="' . esc_attr( 'View all posts in ' . $tag->name ) . '" >' . esc_html( $tag->name ) . '</a> </li> ';
			}
			echo '</ul>';
		}
		?>
	</div><!--end box-->

</div>

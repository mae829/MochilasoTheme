<?php
/**
 * Template part to display post meta data
 *
 * @package mochilaso
 */

?>
<p class="meta">
	<span class="date"><em>Posted on:</em> <?php the_time( 'F jS, Y' ); ?></span>
	<em>by</em> <?php the_author_posts_link(); ?>  |
	<?php if ( get_post_custom_values( 'location' ) === $location ) : ?>
	<em>Posted from:</em> <a href="http://maps.google.com/maps?z=4&q=<?php echo esc_url( $location[0] ); ?>"><span class="location"><?php echo esc_html( $location[0] ); ?></span></a> |
	<?php endif; ?>
	<?php if ( function_exists( 'get_geocode_latlng' ) ) { ?>
		<div class="coordinates"><?php echo esc_html( get_geocode_latlng( $post->ID ) ); ?></div>
	<?php } ?>
	<?php comments_popup_link( 'No Comments', '1 Comment', '% Comments', 'comments-link', '' ); ?> |
	<span class="tags"><?php the_tags( 'Tags: ', ', ', '' ); ?></span>
</p>

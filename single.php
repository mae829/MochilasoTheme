<?php
/**
 * The template for displaying all single posts
 *
 * @package mochilaso
 */

get_header();
?>
		<div id="content">
			<div class="grid_4">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					$location = get_post_custom_values( 'location' );
					?>

				<div <?php post_class( 'box' ); ?> id="post-<?php the_ID(); ?>">

					<h2><?php the_title(); ?></h2>

					<?php include get_template_directory() . '/inc/meta.php'; ?>

					<div class="entry">
						<?php if ( ! empty( $location ) ) : ?>
						<img src="http://maps.google.com/maps/api/staticmap?center=<?php echo esc_url( $location[0] ); ?>&zoom=6&size=275x275&markers=color:blue|label:T|<?php echo esc_url( $location[0] ); ?>&sensor=false" alt="<?php echo esc_attr( $location[0] ); ?>" class="gmap-single" />
						<?php endif; ?>

						<?php the_content(); ?>

						<?php if ( ! empty( $location ) ) : ?>
						Posted from: <a href="http://maps.google.com/maps?z=5&q=<?php echo esc_url( $location[0] ); ?>"><span class="location"><?php echo esc_html( $location[0] ); ?></span></a><br />
						<?php endif; ?>

						<?php
						wp_link_pages(
							array(
								'before'         => 'Pages: ',
								'next_or_number' => 'number',
							)
						);
						?>

										<?php the_tags( 'Tags: ', ', ', '' ); ?>

					</div>

					<div class="clear"></div>

									<?php edit_post_link( 'Edit this entry', '', '.' ); ?>
				</div>
						<?php
		endwhile;
endif;
			?>
			<div id="content-secondary">
				<div id="comments">
					<?php comments_template(); ?>
				</div>
			</div><!--END CONTENT-SECONDARY-->

			</div>
<?php get_sidebar( 'images' ); ?>
			<div class="clear"></div>
		</div>

<?php get_footer(); ?>

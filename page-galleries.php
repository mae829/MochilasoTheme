<?php
/**
 * The template for displaying the galleries page
 *
 * @package mochilaso
 */

get_header();
?>

	<div id="content">

		<div class="grid_4">

			<h2 class="page-title"><?php the_title(); ?></h2>

			<?php
			global $wp_query;

			$galleries_args = array(
				'post_type'      => 'gallery',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			);

			$galleries_query = new WP_Query( $galleries_args );

			if ( $galleries_query->have_posts() ) :
				?>

				<ul id="galleries">
				<?php
				while ( $galleries_query->have_posts() ) :
					$galleries_query->the_post();
					?>
						<?php show_first_image(); ?>
					<?php endwhile; ?>
				</ul>

			<?php else : ?>
				<p>Cannot find any posts at the moment.</p>
			<?php endif; ?>

		</div><!-- end .grid_4 -->

		<?php get_sidebar(); ?>

		<div class="clear"></div>

	</div><!-- end #content -->

<?php get_footer(); ?>

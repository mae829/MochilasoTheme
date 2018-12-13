<?php
/**
 * The template for displaying all pages
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
				?>

				<div class="post" id="post-<?php the_ID(); ?>">

					<h2><?php the_title(); ?></h2>

					<div class="entry">

						<?php
						the_content();

						wp_link_pages(
							array(
								'before'         => 'Pages: ',
								'next_or_number' => 'number',
							)
						);
						?>

					</div>

				</div>

				<?php
			endwhile;
		endif;
		?>
		</div><!--END GRID_4-->
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div><!--END CONTENT-->
<?php get_footer(); ?>

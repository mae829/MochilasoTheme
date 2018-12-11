<?php get_header(); ?>
		<div id="content">
			<div class="grid_4">
			<div class="box">
			<?php if ( have_posts() ) : ?>
		
				<h2>Search Results</h2>
		
				<?php include TEMPLATEPATH . '/inc/nav.php'; ?>
		
				<?php
				while ( have_posts() ) :
					the_post();
					?>
		
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
						<?php include TEMPLATEPATH . '/inc/meta.php'; ?>
		
						<div class="entry">
		
							<?php the_excerpt(); ?>
		
						</div>
		
					</div>
		
				<?php endwhile; ?>
		
				<?php include TEMPLATEPATH . '/inc/nav.php'; ?>
		
			<?php else : ?>
		
				<h2>No posts found.</h2>
		
			<?php endif; ?>
		</div><!--end box-->
		</div><!--end grid_4-->
	<?php get_sidebar( 'images' ); ?>

<?php get_footer(); ?>

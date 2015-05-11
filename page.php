<?php get_header(); ?>
	<div id="content">
        <div class="grid_4">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
            <div class="post" id="post-<?php the_ID(); ?>">
    
                <h2><?php the_title(); ?></h2>
    
                <div class="entry">
    
                    <?php the_content(); ?>
    
                    <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    
                </div>
    
                <?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
    
            </div>
		
		<?php //comments_template(); ?>

		<?php endwhile; endif; ?>
		</div><!--END GRID_4-->
<?php get_sidebar(); ?>
        <div class="clear"></div>
    </div><!--END CONTENT-->
<?php get_footer(); ?>

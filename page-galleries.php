<?php get_header(); ?>
        <div id="content">
        	<div class="grid_4">
                <h2 class="page-title"><?php the_title(); ?></h2>
                <?php 
                    global $wp_query;
                    $wp_query = new WP_Query("post_type=gallery&post_status=publish&posts_per_page=-1");
                    if ($wp_query->have_posts()) : 
				?> 
                <ul id="galleries">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <?php show_first_image(); ?>
                <?php endwhile; ?>
                </ul>
                <?php //my_paginate_links(); ?>
                <?php else : ?>
                <p>Cannot find any posts at the moment.</p>
                <?php endif; ?>
        	</div>
<?php get_sidebar(); ?>
            <div class="clear"></div>
        </div><!--END CONTENT-->

<?php get_footer(); ?>
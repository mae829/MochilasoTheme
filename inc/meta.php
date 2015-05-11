<p class="meta">
	<span class="date"><em>Posted on:</em> <?php the_time('F jS, Y') ?></span>
	<em>by</em> <?php the_author_posts_link(); ?>  |  
    <?php if($location = get_post_custom_values('location')) : ?>
    <em>Posted from:</em> <a href="http://maps.google.com/maps?z=4&q=<?php echo $location[0]; ?>"><span class="location"><?php echo $location[0]?></span></a> |
    <?php endif;?>
    <div class="coordinates"><?php echo get_geocode_latlng($post->ID); ?></div>
	<?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?> | 
    <span class="tags"><?php the_tags( 'Tags: ', ', ', ''); ?></span>
</p>
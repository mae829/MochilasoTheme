<?php get_header(); ?>
	<div id="geocodeResults"></div>
	<?php global $query_string; $doubled_query = $query_string; ?>
		<div id="content">
			<div class="grid_1">
                <h2>Danny's Entries</h2>
                <div class="box">
                <?php 
                    query_posts('author_name=danny&posts_per_page=-1'); 
                    if(have_posts()) :
                ?>
                    <ul>
                    <?php while (have_posts()) : the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                </div><!--end box-->
            
            </div><!--end grid_1-->



            <div id="post-listing" class="grid_3">

            	<div class="box">
                <?php query_posts( $query_string . '&posts_per_page=-1' ); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
                    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="pull">    
                          <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                              
                            <p class="meta">
                                <span class="date"><em>Posted on:</em> <?php the_time('F jS, Y') ?></span>
                                <em>by</em> <?php the_author_posts_link(); ?>  |  
                                <?php if($location = get_post_custom_values('location')) : ?>
                                <em>Posted from:</em> <a href="http://maps.google.com/maps?z=4&q=<?php echo $location[0]; ?>"><span class="location"><?php echo $location[0]?></span></a> |
                                <?php endif;?>
                                <div class="coordinates"><?php echo get_geocode_latlng($post->ID); ?></div>
                            </p>
                              
                          <div class="entry">
                              <?php the_excerpt(); ?>
                          </div>
                              
                        </div><!--END PULL-->
                        
                    </div>
                <?php endwhile; ?>
            
                <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
            
                <?php else : ?>
            
                    <h2>Not Entries Found</h2>
            
                <?php endif; ?>
                </div>
            </div><!--end post-listing-->
            
            
            <div id="map-holder" class="grid_3">
            	<div class="box">
                <div id="map" class="gmap3"></div>
                </div>
            </div><!--end map-holder-->
            
            
            <div class="grid_1">
                <h2>Andres' Entries</h2>
                <div class="box">
                <?php 
                    query_posts('author_name=andres&posts_per_page=-1'); 
                    if(have_posts()) :
                ?>
                    <ul>
                    <?php while (have_posts()) : the_post(); ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                </div><!--end box-->
			</div>
            <div class="clear"></div>
            
            
            <div id="content-secondary">
                <h1>Los Topete</h1>
                <div class="grid_2">
                  <a href="http://www.mochilaso.com/author/andres/"><img src="<?php bloginfo('template_url'); ?>/images/topete-andres.jpg" alt="Andres" /></a>
                  <h2 class="name">Andres Luken Topete</h2>
                </div>
                <div class="grid_2">
                  <a href="http://www.mochilaso.com/author/danny/"><img src="<?php bloginfo('template_url'); ?>/images/topete-danny.jpg" alt="Danny" /></a>
                  <h2 class="name">Daniel Romero Topete</h2>
                </div>
                <div class="clear"></div>
            </div><!--END CONTENT-SECONDARY-->
		</div><!--END CONTENT-->   
  
<?php get_footer(); ?>
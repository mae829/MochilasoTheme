<div id="sidebar" class="grid_1">
    <div class="box">
    	<h2>Latest Entries</h2>
        <ul>
		<?php 
            wp_get_archives(array(
                'type' => 'postbypost', // or daily, weekly, monthly, yearly
                'limit' => 5, // maximum number shown
                'format' => 'html', // or select (dropdown), link, or custom
                'show_post_count' => false, // show number of posts per link
                'echo' => 1 // display results or return array
            )); 
        ?>
        </ul>
    
        <h2>Locations</h2>
        <?php
            $tags = get_tags();
            if ($tags) {
                echo '<ul>';
                foreach ($tags as $tag) {
                    echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name.'</a> </li> ';
                }
                echo '</ul>';
            }
        ?>
        
        <h2>Random Image</h2>
                
        <?php 
			query_posts('showposts=1&post_type=gallery&orderby=rand');
			while (have_posts()) : the_post();
			
				$images_args = array(
					'post_parent'    => get_the_ID(),
					'post_type'      => 'attachment',
					'numberposts'    => 1, // show all
					'post_status'    => null,
					'post_mime_type' => 'image',
					'orderby'		 => 'rand',
				);
				$images = get_children($images_args);
				$theme_url = get_bloginfo('template_url');
				if($images){
					foreach($images as $image) {
						$imgThumb    = wp_get_attachment_image($image->ID,'thumbnail'); //thumbnail full img tag
						$imgPermalink = get_permalink($image->ID);
						echo "<a href=\"$imgPermalink\">
									$imgThumb
								</a>";
					}
				}else {
					echo "<p>No images are in this gallery</p>";
				}
				
			endwhile;
        ?>
        
        
    </div><!--end box-->

</div>
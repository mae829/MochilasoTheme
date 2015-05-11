<?php 
/*
Template Name: Tutorial
*/
?>
<?php get_header(); ?>
        <div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php the_title(); ?>

		<?php 
				$args = array(
					'post_parent'    => get_the_ID(),
					'post_type'      => 'attachment',
					'numberposts'    => -1, // show all
					'post_status'    => null,
					'post_mime_type' => 'image',
					'offset'		 => 0,
					'orderby'		 => 'menu_order',
					'order'			 => 'ASC'
				);
				$images = get_children($args);
				$counter = 0;
				$theme_url = get_bloginfo('template_url');
		
				if($images) {
					
					foreach($images as $image) {
						$imgThumb    = wp_get_attachment_image($image->ID,'thumbnail'); //thumbnail full img tag
						$imgMed      = wp_get_attachment_image_src($image->ID,'medium'); //medium full img tag
						$imageLarge  = wp_get_attachment_image_src($image->ID,'large'); //large image url
						$imageFull   = wp_get_attachment_image_src($image->ID, 'full'); //full size image url
						$imgPermalink = get_permalink($image->ID);;
						$counter++;
						
						echo "<h3>Step $counter</h3>\n";
						
						echo "<img src=\"$imageFull[0]\" alt=\"Step $counter\" />";
					}
					
		
				} else {
					echo "<p>No images are in this tutorial</p>";
				}

		?>


    	<?php the_content(); ?>
		<?php endwhile; endif; ?>
    	</div>
<?php get_footer(); ?>
<?php
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => 'Sidebar Widgets',
			'id'   => 'sidebar-widgets',
			'description'   => 'These are widgets for the sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
		));
	}

	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}

	######### ADD 'READ MORE' TO EXCERPT #########
	function new_excerpt_more($more) {
		   global $post;
		return ' <a href="'. get_permalink($post->ID) . '" class="read-more-link">...[read more]</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'start_post_rel_link', 10, 0 );
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'rel_canonical');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
	
	register_nav_menus(array(
		'tags' => __('Tag Navigation', 'tag')
	));
	add_action('nav_init', 'custom_navs');


	######### CUSTOM POST TYPES #########
	function register_post_type_gallery() {
		$args = array(
			'label' => __('Galleries'),
			'singular_label' => __('Gallery'),
			'public' => true,
			'capability_type' => 'post',
			'rewrite' => array('slug' => 'galleries'),
			'show_ui' => true,
			'supports' => array(
				'title',
				'editor',
				//'trackbacks',
				//'custom-fields',
				'comments',
				'revisions',
				'thumbnail',
				'author'
				//'page-attributes'
			)
		);
		
		register_post_type('gallery', $args);
		register_taxonomy_for_object_type('post_tag', 'gallery');
		register_taxonomy_for_object_type('category', 'gallery');
	}
	add_action('init', 'register_post_type_gallery');


	function show_first_image(){
		
		$args = array(
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
			'numberposts'    => 1, // show first image only
			'post_status'    => null,
			'post_mime_type' => 'image',
			'orderby'		 => 'menu_order',
			'order'			 => 'ASC'
		);
		$posttitle = get_the_title();
		$images = get_children($args);
		if($images){
			foreach($images as $image) {
				$imgThumb    = wp_get_attachment_image_src($image->ID,'thumbnail'); //thumbnail full img tag
				$imgMed      = wp_get_attachment_image_src($image->ID,'medium'); //medium full img tag
				$imageLarge  = wp_get_attachment_image_src($image->ID,'large'); //large image url
				$postlink 	 = get_permalink($image->post_parent);
				$imgTitle    = apply_filters('the_title',$image->post_title);
				
				echo "<li><a href=\"$postlink\"><img class=\"thumb\" src=\"$imgThumb[0]\" alt=\"$imgTitle\" /><br />$posttitle</a></li>\n";
				//break; //exit the foreach loop after the first image (logo)
			}
		} else {
			echo the_title()."<br />
				  Currently has no images";
		}
	}

?>
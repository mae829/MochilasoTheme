<?php
/**
 * Mochilaso functions and definitions
 *
 * @package mochilaso
 */

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
			'name'          => 'Sidebar Widgets',
			'id'            => 'sidebar-widgets',
			'description'   => 'These are widgets for the sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Enqueue our files
 */
function enqueue_files() {
	$theme_info = wp_get_theme();
	$theme_ver  = $theme_info->get( 'Version' );

	// Stylesheets.
	wp_enqueue_style( 'google-font-lobster', 'http://fonts.googleapis.com/css?family=Lobster', array(), $theme_ver );
	wp_enqueue_style( 'google-font-cabin', 'http://fonts.googleapis.com/css?family=Cabin', array(), $theme_ver );
	wp_enqueue_style( 'mochilaso', get_stylesheet_directory_uri() . '/css/style.min.css', array(), filemtime( get_template_directory() . '/css/style.min.css' ) );

	// Load our IE version-specific stylesheet:
	// <!--[if lte IE 7]> ... <![endif]-->.
	wp_enqueue_style( 'mochilaso-lte-ie7', get_stylesheet_directory_uri() . '/css/ie.min.css', array( 'mochilaso' ), filemtime( get_template_directory() . '/css/ie.css' ) );
	wp_style_add_data( 'mochilaso-lte-ie7', 'conditional', 'lte IE 7' );

	// Scripts.
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js', array(), $theme_ver, true );
	}

	wp_enqueue_script( 'mochilaso-head', get_stylesheet_directory_uri() . '/js/head.min.js', array(), filemtime( get_template_directory() . '/js/head.min.js' ), false );

	if ( is_home() ) {
		wp_enqueue_script( 'google-maps-api', 'http://maps.google.com/maps/api/js?sensor=false', array(), $theme_ver, true );
		wp_enqueue_script( 'mochilaso-front-page', get_stylesheet_directory_uri() . '/js/front-page.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/front-page.min.js' ), true );
	} else {
		wp_enqueue_script( 'mochilaso-init', get_stylesheet_directory_uri() . '/js/theme.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/theme.min.js' ), true );
	}

	// Load our IE version-specific stylesheet:
	// <!--[if IE]> ... <![endif]-->.
	wp_enqueue_script( 'mochilaso-ie', get_stylesheet_directory_uri() . '/js/ie.min.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/ie.min.js' ), true );
	wp_script_add_data( 'mochilaso-ie', 'conditional', 'IE' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_files' );

/**
 * Add "read more" to excerpt
 *
 * @param string $more String holding the ellipsis.
 */
function new_excerpt_more( $more ) {
	global $post;
	return ' <a href="' . get_permalink( $post->ID ) . '" class="read-more-link">...[read more]</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/**
 * Clean up the <head>.
 */
function remove_head_link() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'rel_canonical' );
}
add_action( 'init', 'remove_head_link' );
remove_action( 'wp_head', 'wp_generator' );

register_nav_menus(
	array(
		'tags' => __( 'Tag Navigation', 'tag' ),
	)
);
add_action( 'nav_init', 'custom_navs' );


/**
 * Register the custom post types
 */
function register_post_type_gallery() {
	$args = array(
		'label'           => __( 'Galleries' ),
		'singular_label'  => __( 'Gallery' ),
		'public'          => true,
		'capability_type' => 'post',
		'rewrite'         => array( 'slug' => 'galleries' ),
		'show_ui'         => true,
		'supports'        => array(
			'title',
			'editor',
			'comments',
			'revisions',
			'thumbnail',
			'author',
		),
	);

	register_post_type( 'gallery', $args );
	register_taxonomy_for_object_type( 'post_tag', 'gallery' );
	register_taxonomy_for_object_type( 'category', 'gallery' );
}
add_action( 'init', 'register_post_type_gallery' );

/**
 * Utility function to show the first image attached to a post.
 */
function show_first_image() {
	$args      = array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => 1, // show first image only.
		'post_status'    => null,
		'post_mime_type' => 'image',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$posttitle = get_the_title();
	$images    = get_children( $args );
	if ( $images ) {
		foreach ( $images as $image ) {
			$img_thumb = wp_get_attachment_image_src( $image->ID, 'thumbnail' ); // thumbnail full img tag.
			$img_med   = wp_get_attachment_image_src( $image->ID, 'medium' ); // medium full img tag.
			$img_large = wp_get_attachment_image_src( $image->ID, 'large' ); // large image url.
			$postlink  = get_permalink( $image->post_parent );
			$img_title = apply_filters( 'the_title', $image->post_title );

			echo '<li><a href="' . esc_url( $postlink ) . '"><img class="thumb" src="' . esc_url( $img_thumb[0] ) . '" alt="' . esc_attr( $img_title ) . '" /><br />' . esc_html( $img_title ) . '</a></li>' . "\n";
			// break; //exit the foreach loop after the first image (logo).
		}
	} else {
		echo the_title() . '<br />
				Currently has no images';
	}
}

/**
 * Modify the main query on the home page to grab all posts
 *
 * @param object $query The main WP query.
 */
function grab_all_posts_on_home_main( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) { // Run only on the homepage.
		$query->query_vars['posts_per_page'] = -1; // Grab all the posts.
	}
}
add_action( 'pre_get_posts', 'grab_all_posts_on_home_main' );

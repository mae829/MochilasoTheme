<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!--Design and layout by Miguel Estrada-->
        <!--Coded by Miguel Estrada-->
        <!--META DATA-->
        <meta charset="utf-8" />
        <meta name="author" content="Miguel Estrada, Bleu Mikey, MikeE, , MAE Design, http://bleucellar.com" />
        <?php if (is_search()) { ?>
        <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>
    
        <!--META DATA SPECIFIC TO SITE--> 
        <meta name="copyright" content="Copyright <?php echo date('Y');?>" />
        <meta name="keywords" content="danny romero, daniel romero, andres luken, mochilaso, mochilaso.com, los topete, topete, topetes, travel, backpacking" />
        <meta name="description" content="Los Topete's diary and images from their trip through South America - Mochilaso.com" />
        
        <title>
               <?php
                  if (function_exists('is_tag') && is_tag()) {
                     single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
                  elseif (is_archive()) {
                     wp_title(''); echo ' Archive - '; }
                  elseif (is_search()) {
                     echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
                  elseif (!(is_404()) && (is_single()) || (is_page())) {
                     wp_title(''); echo ' - '; }
                  elseif (is_404()) {
                     echo 'Not Found - '; }
                  if (is_home()) {
                     bloginfo('name'); echo ' - '; bloginfo('description'); }
                  else {
                      bloginfo('name'); }
                  if ($paged>1) {
                     echo ' - page '. $paged; }
               ?>
        </title>
        
        <!--FAVICON-->
        <link rel="icon" href="<?php bloginfo('template_url');?>/images/favicon.png" />
        
        <!-- Stylesheets -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />
		<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Cabin' />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
        
        <!--[if lte IE 7]>
        	<link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie.css" type="text/css" />
        <![endif]-->

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
        <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    
        <?php wp_head(); ?>
        <script src="<?php bloginfo('template_url');?>/js/head.min.js"></script>
        <?php if(is_home()):?>
		<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="<?php bloginfo('template_url');?>/js/plugins.js"></script>
        <script>
			var $theme_location = '<?php bloginfo('template_url');?>';
        </script>
        <script src="<?php bloginfo('template_url');?>/js/init-map.min.js"></script>
		<?php else: ?>
        <script src="<?php bloginfo('template_url');?>/js/init.js"></script>
        <?php endif; ?>
        <!--[if IE]>
            <script type="text/javascript" src="<?php bloginfo('template_url');?>/js/ie.js"></script>
        <![endif]-->    
    </head>
    
    <body <?php body_class(); ?>>
    	<?php if(is_home()):?>
        <div class="no-js">
          <p>This page depends heavily on Javascript being turned on, please enable Javascript, update your browser, or download a new browser, like <a href="http://www.google.com/chrome">Google Chrome</a>.</p>
        </div>
        <?php endif; ?>
    	<div id="main">
        	<div class="wrapper">
                <header>
                    <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
                    <img src="<?php bloginfo('template_url');?>/images/hikers.png" alt="Hikers" id="hikers" />
                    <!-- Navigation Menu -->
                <?php wp_page_menu('show_home=Map'); ?>
                </header>
                <div class="clear"></div>
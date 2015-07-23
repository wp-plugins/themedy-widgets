<?php
/*
Plugin Name: Themedy Widgets
Plugin URI: http://themedy.com
Description: A selection of widgets to extend your Themedy site even further.
Version: 1.0.1
Author: Themedy
Author URI: http://themedy.com
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Localization
load_child_theme_textdomain( 'themedy', 'includes/languages');

// Add Widgets - trying to avoid white screen of death if user is using older theme with widgets built in
add_action( 'after_setup_theme', 'themedy_widget_setup' );
function themedy_widget_setup() {
	if ( !class_exists( 'themedy_video_widget' )) {
		include('includes/widgets/widget-video.php');
	}
	if ( !class_exists( 'themedy_ad120x60_widget' )) {
		include('includes/widgets/widget-ad120x60.php');
	}
	if ( !class_exists( 'themedy_ad120x240_widget' )) {
		include('includes/widgets/widget-ad120x240.php');
	}
	if ( !class_exists( 'themedy_ad_widget' )) {
		include('includes/widgets/widget-ad125.php');
	}
	if ( !class_exists( 'themedy_ad300_widget' )) {
		include('includes/widgets/widget-ad300x250.php');
	}
	if ( !class_exists( 'themedy_ad300x600_widget' )) {
		include('includes/widgets/widget-ad300x600.php');

	}
	if ( !class_exists( 'themedy_flickr_widget' )) {
		include('includes/widgets/widget-flickr.php');
	}
	if ( !class_exists( 'themedy_tab_widgets' )) {
		include('includes/widgets/widget-tabbed.php');
	}
}
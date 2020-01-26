<?php
/**
 * admin_bar_menu - Remove links from top admin bar.
 */
add_action('admin_bar_menu', 'sc_remove_toolbar_nodes', 999);

function sc_remove_toolbar_nodes($wp_admin_bar) {
	global $wp_admin_bar;
	$options = get_option('sc_utility_settings');
	if (isset($options['top_admin']) == 1) {
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('themes');
		$wp_admin_bar->remove_menu('widgets');
		$wp_admin_bar->remove_menu('menus');
		$wp_admin_bar->remove_menu('customize');
	}
}

/**
 * Limit number of revisions to save.
 */
add_filter( 'wp_revisions_to_keep', 'sc_limit_revisions', 10, 2 );

function sc_limit_revisions($num, $post) {
	$options = get_option('sc_utility_settings');
	if (isset($options['revisions_saved']) >= 0) {
		$num = $options['revisions_saved']; 
		return $num;
	}
}

/**
 * Remove emojis
 */  
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

/**
 * Remove remote-access and pingback functionality header links
 */ 
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Hide admin 'Screen Options' tab
 * The screen options tab is rendered useless by options to remove items from post and pages 
 * so we need to hide it.
 */ 

add_filter('screen_options_show_screen', 'remove_screen_options_tab');

function remove_screen_options_tab() {
	$options = get_option('sc_utility_settings');
	if (isset($options['screen_options']) == 1) {
		return false;
	}
	// return false;
}
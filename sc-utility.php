<?php
/**
 * Plugin Name: SC Utility
 * Plugin URI: https://github.com/simplycomputing/sc-utility
 * Description: Add dashboard support widget, simplify the user interface
 * Version: 1.0.4
 * Author: Alan Coggins
 * Author URI: https://simplycomputing.com.au
 * License: GPLv2
 * 
 * Copyright 2019  Alan Coggins  (email : mail@simplycomputing.com.au)
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
*/

namespace simplycomputing\scutility;

defined('ABSPATH') or die('No direct access allowed!');

require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/updater.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/init.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/SettingsClass.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/DashboardWidgets.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/Menus.php');

/*
* Hide Shield Security.
*/

function custom_menu_page_removing() {

    $options = get_option('sc_utility_settings');
    
    if (isset($options['shield']) == 1)
        remove_menu_page( 'icwp-wpsf' );
}

add_action( 'admin_menu', 'custom_menu_page_removing', 999);


/*
 * Remove items from post and pages.
 */

    add_action('admin_init', 'sc_remove_boxes');

    function sc_remove_boxes() {

    $options = get_option('sc_utility_settings');

        if (isset($options['attributes']) == 1)
            remove_meta_box('pageparentdiv', 'page', 'normal'); // Page attributes
        if (isset($options['custom_fields']) == 1)
            remove_meta_box('postcustom', 'page', 'normal'); // Custom fields in pages
        if (isset($options['comments']) == 1)
            remove_meta_box('commentsdiv', 'page', 'normal'); // Comments in pages
        if (isset($options['discussion']) == 1)
            remove_meta_box('commentstatusdiv', 'page', 'normal'); // Discussions in pages
        if (isset($options['revisions']) == 1)
            remove_meta_box('revisionsdiv', 'page', 'normal'); //Revisions in pages
        if (isset($options['authors']) == 1)
            remove_meta_box('authordiv', 'page', 'normal'); // Authors in pages
        if (isset($options['format']) == 1)
            remove_meta_box('formatdiv', 'page', 'normal'); // Format in pages

        if (isset($options['custom_fields']) == 1)
            remove_meta_box('postcustom', 'post', 'normal'); // Custom fields in posts
        if (isset($options['comments']) == 1)
            remove_meta_box('commentsdiv', 'post', 'normal'); // Comments in posts
        if (isset($options['categories']) == 1)
            remove_meta_box('categorydiv', 'post', 'normal'); // Categories in posts
        if (isset($options['discussion']) == 1)
            remove_meta_box('commentstatusdiv', 'post', 'normal'); // Discussion in posts
        if (isset($options['slug']) == 1)
            add_action( 'admin_head', 'hide_all_slugs'  ); // Slugs in posts and pages
        if (isset($options['tags']) == 1)
            remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // Tags in posts
        if (isset($options['excerpts']) == 1)
            remove_meta_box('postexcerpt', 'post', 'normal'); // Excerpts in posts
        if (isset($options['trackbacks']) == 1)
            remove_meta_box('trackbacksdiv', 'post', 'normal'); // Trackbacks in posts
        if (isset($options['revisions']) == 1)
           remove_meta_box('revisionsdiv', 'post', 'normal'); // Revisions in posts
        if (isset($options['authors']) == 1)
            remove_meta_box('authordiv', 'post', 'normal'); // Authors in posts
        if (isset($options['format']) == 1)
            remove_meta_box('formatdiv', 'post', 'normal'); // Format in posts

    }

    function sc_remove_layout_meta_box() {

        $options = get_option('sc_utility_settings');

        if (isset($options['format']) == 1)
          remove_meta_box('generate_layout_options_meta_box', 'post', 'normal');

        if (isset($options['format']) == 1)
          remove_meta_box('generate_layout_options_meta_box', 'page', 'normal');
    }


/*
 * Disable most of the main dashboard widgets.
 */

    add_action('admin_menu', 'sc_disable_dashboard_widgets');

    function sc_disable_dashboard_widgets() {

        $options = get_option('sc_utility_settings');

        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_activity', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_action('welcome_panel', 'wp_welcome_panel');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_primary', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_petitions', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('wordfence_activity_report_widget', 'dashboard', 'core');


}


/*
 * Remove links from top admin bar.
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


/*
 * Add 'widgets' link to side admin menu.
 */

    add_action('admin_menu', 'sc_add_widgets_item');

    function sc_add_widgets_item() {

        $options = get_option('sc_utility_settings');

        if (isset($options['add_widgets']) == 1)
            add_menu_page(__('Widgets'), __('Widgets'), 'read', 'widgets.php');

    }


/*
 * Add 'menus' link to side admin menu.
 */

    add_action('admin_menu', 'sc_add_menus_item');

    function sc_add_menus_item() {

        $options = get_option('sc_utility_settings');

        if (isset($options['add_menus']) == 1)
            add_menu_page(__('Menus'), __('Menus'), 'read', 'nav-menus.php');

  }

/*
* Hide slug editing areas at top and bottom of pages and posts.
*/

    function hide_all_slugs() {
        echo '<style type="text/css"> #slugdiv, #edit-slug-box { display: none; }</style>';
    }



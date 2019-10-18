<?php
/*
Plugin Name: SC Utility
Plugin URI: https://github.com/simplycomputing/sc-utility
Description: Modify the dashboard widgets, simplify the user interface.

Version: 1.1.0

Author: Alan Coggins
Author URI: https://simplycomputing.com.au
License: GPLv2
*/

/*  Copyright 2019  Alan Coggins  (email : mail@simplycomputing.com.au)

 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.

*/

  defined('ABSPATH') or die('No direct access allowed!');

/*
 * Include plugin updater.
 */


  require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/updater.php');

  register_activation_hook(__FILE__, 'sc_utility_initialise');

  function sc_utility_initialise() {

    $current_user = wp_get_current_user();

    update_option('sc_admin_user', $current_user->user_login);

    set_transient('sc-admin-notice', true, 5);

  }

  add_action('admin_notices', 'sc_admin_notice');

  function sc_admin_notice() {

  /*
   * Check transient, if available display notice
   */


  if(get_transient('sc-admin-notice')){
    ?>
    <div class="updated notice is-dismissible">
      <p><strong>This plugin is now locked to admin user: <?php echo get_option('sc_admin_user') ?></strong>.</p>
      <p>Only <?php echo get_option('sc_admin_user') ?> will be able to see the link on the side menu.</p>
    </div>
    <?php
    /* Delete transient, only display this notice once. */
    delete_transient('sc-admin-notice');
    }
  }


/*
 * Register the settings page for the utility plugin.
 */

  require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/register-settings.php');


/*
 * Add and enhance widgets on the admin dashboard.
 */

  require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/dashboard-widgets.php');


/*
 * Customise the admin menu.
 */

  require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/admin-menu.php');


/*
 * Customise pages and posts.
 */

  require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/pages-posts.php');



// Other miscellaneous settings
// ============================


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


/*
 * Create a custom post type to store contact messages.
 */

  add_action('init','sc_message_record');

  function sc_message_record () {

    $options = get_option('sc_utility_settings');

    if (isset($options['messages_saved']) == 1) {

      register_post_type('messages',
        array(
        	'labels' => array('name' => 'Messages'),
          'public' => true,
          'publicly_queryable' => false, // Stops the record from being accessible to the public 
          'exclude_from_search' => true, 
          'menu_icon' => 'dashicons-email',
          'show_in_menu' => true,
          'show_in_nav_menus' => false,
          'capability_type' => 'post',
          'capabilities' => array(
            'create_posts' => 'do_not_allow', // Removes support for the "Add New" function
            ),
            'map_meta_cap' => true, // Set to false, if users are not allowed to edit/delete existing posts
            )
          );
    }
  }

/*
 * Remove emojis
 */  

	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	add_filter('emoji_svg_url', '__return_false');


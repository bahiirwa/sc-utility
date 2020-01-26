<?php
/**
 * Plugin Name: SC Utility
 * Plugin URI: https://github.com/simplycomputing/sc-utility
 * Description: Modify the dashboard widgets, simplify the user interface.
 * Version: 1.1.2
 * Author: Alan Coggins
 * Author URI: https://simplycomputing.com.au
 * License: GPLv2
 * 
 * Copyright 2019  Alan Coggins  (email : mail@simplycomputing.com.au)
 * 
 * This is free software released under the terms of the General Public License,
 * version 2, or later. It is distributed WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. Full
 * text of the license is available at https://www.gnu.org/licenses/gpl-2.0.txt.
 */

defined('ABSPATH') or die('No direct access allowed!');

/**
 * Add the required files in the plugin.
 */
// Include plugin updater - Load the Update Client.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'classes/UpdateClient.class.php');

// Register the settings page for the utility plugin.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/register-settings.php');

// Add and enhance widgets on the admin dashboard.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/dashboard-widgets.php');

// Customise the admin menu.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/admin-menu.php');

// Customise pages and posts.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/pages-posts.php');

// Customise pages and posts.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/admin-emails.php');

// Other miscellaneous settings 
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/other-settings.php');

/**
 * Run sc_utility_initialise() on plugin install.
 */
register_activation_hook(__FILE__, 'sc_utility_initialise');

// Set the user on activation of plugin.
function sc_utility_initialise() {
	$current_user = wp_get_current_user();
	update_option('sc_admin_user', $current_user->user_login);
	set_transient('sc-admin-notice', true, 5);
}

/**
 * Add admin notice for the user with admin lock.
 */
add_action('admin_notices', 'sc_admin_notice');

function sc_admin_notice() {
	// Check transient, if it is available display notice
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
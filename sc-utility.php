<?php
/**
 * Plugin Name: SC Utility
 * Plugin URI: https://github.com/simplycomputing/sc-utility
 * Description: Add dashboard support widget, simplify the user interface
 * Version: 1.0.5
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

namespace simplycomputing\sc_utility;

defined('ABSPATH') or die('No direct access allowed!');

// Start the plugin
register_activation_hook(__FILE__, __NAMESPACE__ . '\sc_utility_initialise');

// Set user for the plugin admin.
function sc_utility_initialise() {
    $current_user = wp_get_current_user();
    update_option('sc_admin_user', $current_user->user_login);
    set_transient('sc-admin-notice', true, 5);
}

require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/init.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/updater.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/SettingsClass.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/DashboardWidgets.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/Menus.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/PostTypesOptions.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/Metaboxes.php');
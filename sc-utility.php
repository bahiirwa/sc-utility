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


/**
 * Start the plugin
 */
register_activation_hook(__FILE__, 'sc_utility_initialise');

function sc_utility_initialise() {

    $current_user = wp_get_current_user();
    update_option('sc_admin_user', $current_user->user_login);
    set_transient('sc-admin-notice', true, 5);

}

add_action('admin_notices', 'sc_admin_notice');

/**
 * Check transient, if available display notice
 */
function sc_admin_notice() {
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

//require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/init.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/updater.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/SettingsClass.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/DashboardWidgets.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/Menus.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/PostTypesOptions.php');
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/Metaboxes.php');
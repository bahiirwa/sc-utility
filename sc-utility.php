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
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'includes/PostTypesOptions.php');

/**
 * Unused function - consider deleting
 */
function sc_remove_layout_meta_box() {

    $options = get_option('sc_utility_settings');

    if (isset($options['format']) == 1)
        remove_meta_box('generate_layout_options_meta_box', 'post', 'normal');

    if (isset($options['format']) == 1)
        remove_meta_box('generate_layout_options_meta_box', 'page', 'normal');
}
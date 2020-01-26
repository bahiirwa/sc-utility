<?php

/**
 * Runs on Uninstall of Simply Computing Utility
 *
 * @package   sc-utility
 * @author    Alan Coggins
 * @license   GPL-2.0+
 * @link      https://simplycomputing.com.au
 */

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
delete_option('sc_utility_settings');
delete_option('sc_admin_user');
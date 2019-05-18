<?php
/*
 * Remove items from admin menu.
 */

add_action('admin_menu', 'sc_remove_admin_menus');

function sc_remove_admin_menus() {

    $options = get_option('sc_utility_settings');

    if (isset($options['comments']) == 1)
        remove_menu_page('edit-comments.php'); // Comments
    if (isset($options['tools']) == 1)
        remove_menu_page('tools.php'); // Tools
    if (isset($options['appearance']) == 1)
        remove_menu_page('themes.php'); // Appearance
    if (isset($options['media']) == 1)
        remove_menu_page('upload.php'); // Media
    if (isset($options['links']) == 1)
        remove_menu_page('link-manager.php'); // Links
    if (isset($options['pages']) == 1)
        remove_menu_page('edit.php?post_type=page'); // Pages
    if (isset($options['plugins']) == 1)
        remove_menu_page('plugins.php'); // Plugins
    if (isset($options['posts']) == 1)
        remove_menu_page('edit.php'); // Posts
    if (isset($options['users']) == 1)
        remove_menu_page('users.php'); // Users
    if (isset($options['settings']) == 1)
        remove_menu_page('options-general.php'); // Settings
}

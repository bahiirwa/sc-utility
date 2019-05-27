<?php
/*
 * Remove items from admin menu.
 */

function sc_remove_admin_menus() {

    $options = get_option('sc_utility_settings');

    // Hide Shield Security.
    if (isset($options['shield']) == 1)
        remove_menu_page( 'icwp-wpsf' );

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
        
    // Add 'menus' link to side admin menu.
    if (isset($options['add_menus']) == 1)
        add_menu_page(__('Menus'), __('Menus'), 'read', 'nav-menus.php');
    // Add 'widgets' link to side admin menu.
    if (isset($options['add_widgets']) == 1)
        add_menu_page(__('Widgets'), __('Widgets'), 'read', 'widgets.php');
}
add_action('admin_menu', 'sc_remove_admin_menus');

/*
 * Remove links from top admin bar.
 */
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
add_action('admin_bar_menu', 'sc_remove_toolbar_nodes', 999);
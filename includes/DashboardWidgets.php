<?php
/**
 * Add a custom widget on the admin dashboard area giving contact details for support.
 */
function sc_custom_dashboard_widget() {

    global $wp_meta_boxes;
    $options = get_option('sc_utility_settings');
    if (isset($options['enable_widget']) == 1)
        wp_add_dashboard_widget('custom_help_widget', $options['title'] . ' Support', 'sc_custom_dashboard_support');

}

function sc_custom_dashboard_support() {

    $options = get_option('sc_utility_settings');
    $image = $options['image'];

    if($image == true ) {
        echo '<p><img src="' . $image . '" style="width:80px;" /></p>';
    }

    echo '<p><b>Need help?</b>
    Contact the developers at ' . $options['title'] . ' by <a href="mailto:' . $options['email'] . '" target=_blank"><u>email</u></a> or phone ' . $options['phone'] . '.<p>';

}
add_action('wp_dashboard_setup', 'sc_custom_dashboard_widget');

/*
 * Disable most of the main dashboard widgets.
 */
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
add_action('admin_menu', 'sc_disable_dashboard_widgets');
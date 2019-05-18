<?php
/**
 * Add a custom widget on the admin dashboard area giving contact details for support.
 */

add_action('wp_dashboard_setup', 'sc_custom_dashboard_widget');

function sc_custom_dashboard_widget() {

    global $wp_meta_boxes;
    $options = get_option('sc_utility_settings');
    if (isset($options['enable_widget']) == 1)
        wp_add_dashboard_widget('custom_help_widget', $options['title'] . ' Support', 'sc_custom_dashboard_support');

}

function sc_custom_dashboard_support() {

    $options = get_option('sc_utility_settings');
    echo '<p><img src="' . $options['image'] . '" style="width:80px;" /></p><p><b>Need help?</b>
    Contact the developers at ' . $options['title'] . ' by <a href="mailto:' . $options['email'] . '" target=_blank"><u>email</u></a> or phone ' . $options['phone'] . '.<p>';

}
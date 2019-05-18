<?php
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
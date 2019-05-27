<?php
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
add_action('admin_notices', 'sc_admin_notice');
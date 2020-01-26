<?php
/**
 * Custom post type for Store contact messages
 * Error log - if there are any php errors email them -> archive the contents.
 */

/**
 * Create a custom post type to store contact messages.
 */
add_action('init','sc_message_record');

function sc_message_record () {
	$options = get_option('sc_utility_settings');
	if (isset($options['messages_saved']) == 1) {
		register_post_type('messages',
			array(
				'labels' => array('name' => 'Messages'),
				'public' => true,
				'publicly_queryable' => false, // Stops the record from being accessible to the public 
				'exclude_from_search' => true, 
				'menu_icon' => 'dashicons-email',
				'show_in_menu' => true,
				'show_in_nav_menus' => false,
				'capability_type' => 'post',
				'capabilities' => array(
					'create_posts' => 'do_not_allow', // Removes support for the "Add New" function
					),
					'map_meta_cap' => true, // Set to false, if users are not allowed to edit/delete existing posts
			)
		);
	}
}

/**
 * Check error log and if there are any php errors email them, then archive the contents.
 */
add_action('sc_error_monitor', 'sc_error_monitor');

function sc_error_monitor() {
	$log_file = ABSPATH . '/error_log';
	$log_archive = ABSPATH . '/error_log.archive';
	$email_to = get_option('admin_email');

	if (filesize($log_file) == 0) { exit; } // Check the error log filesize

	$sContent = $sFullContent = file_get_contents($log_file); // Get file contents

	file_put_contents($log_file,null); // Truncate the error log so we don't email it again

	wp_mail($email_to, 'PHP error report from '.get_bloginfo(), $sContent); // Email content

	$sFullContent = sprintf("----- Full content of error log as mailed @ %s -----\n%s\n", date('d/m/Y H:i:s'), $sFullContent);

	file_put_contents($log_archive, $sFullContent, FILE_APPEND); // Archive the errors
}
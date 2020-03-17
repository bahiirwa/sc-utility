<?php
/**
 * admin_menu settings
 */
/**
 * Provides default values for the Social Options.
 */
function sc_utility_default_admin_menu() {
	
	$defaults = array(
		'twitter'		=>	'',
		'facebook'		=>	'',
		'googleplus'	=>	'',

	);
	
	return apply_filters( 'sc_utility_default_admin_menu', $defaults );
	
} // end sc_utility_default_admin_menu

/**
 * Initializes the theme's social options by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function sc_utility_initialize_admin_menu() {

	if( false == get_option( 'sc_utility_admin_menu' ) ) {	
		add_option( 'sc_utility_admin_menu', apply_filters( 'sc_utility_default_admin_menu', sc_utility_default_admin_menu() ) );
	} // end if
	
	add_settings_section(
		'social_settings_section',			// ID used to identify this section and with which to register options
		__( 'Social Options', 'sandbox' ),		// Title to be displayed on the administration page
		'sandbox_admin_menu_callback',	// Callback used to render the description of the section
		'sc_utility_admin_menu'		// Page on which to add this section of options
	);
	
	add_settings_field(	
		'twitter',						
		'Twitter',							
		'sandbox_twitter_callback',	
		'sc_utility_admin_menu',	
		'social_settings_section'			
	);

	add_settings_field(	
		'facebook',						
		'Facebook',							
		'sandbox_facebook_callback',	
		'sc_utility_admin_menu',	
		'social_settings_section'			
	);
	
	add_settings_field(	
		'googleplus',						
		'Google+',							
		'sandbox_googleplus_callback',	
		'sc_utility_admin_menu',	
		'social_settings_section'			
	);
	
	register_setting(
		'sc_utility_admin_menu',
		'sc_utility_admin_menu',
		'sc_utility_sanitize_admin_menu'
	);
	
} // end sc_utility_initialize_admin_menu
add_action( 'admin_init', 'sc_utility_initialize_admin_menu' );

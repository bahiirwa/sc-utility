<?php
/**
 * Dashboard Setting Registration 
 */ 

/**
 * Provides default values for the Display Options.
 */
function sc_utility_default_dashboard_options() {
	
	$defaults = array(
		'Email_address'	=> '',
		'Title'	=> '',
		'Phone_number'	=> '',
		'Path_to_logo_image'	=> '',
		'Enable_support_widget'	=> '',
		'Hide_other_widget'	=> '',
	);
	
	return apply_filters( 'sc_utility_default_dashboard_options', $defaults );
	
} // end sc_utility_default_dashboard_options

/**
 * Initializes the theme's display options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function sandbox_initialize_theme_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'sc_utility_dashboard_options' ) ) {	
		add_option( 'sc_utility_dashboard_options', apply_filters( 'sc_utility_default_dashboard_options', sc_utility_default_dashboard_options() ) );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'general_settings_section',			// ID used to identify this section and with which to register options
		__( 'Display Options', 'sandbox' ),		// Title to be displayed on the administration page
		'sandbox_dashboard_options_callback',	// Callback used to render the description of the section
		'sc_utility_dashboard_options'		// Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(	
		'Title',						
		__( 'Title', 'sandbox' ),				
		'sandbox_toggle_title_callback',	
		'sc_utility_dashboard_options',					
		'general_settings_section',			
		array(								
			__( 'Title.', 'sandbox' ),
		)
	);
	
	add_settings_field(	
		'Email_address',						// ID used to identify the field throughout the theme
		__( 'Email Address', 'sandbox' ),							// The label to the left of the option interface element
		'sandbox_toggle_Email_address_callback',	// The name of the function responsible for rendering the option interface
		'sc_utility_dashboard_options',	// The page on which this option will be displayed
		'general_settings_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			__( 'Email Address.', 'sandbox' ),
		)
	);
	

	add_settings_field(	
		'Phone_number',						
		__( 'Phone Number', 'sandbox' ),				
		'sandbox_toggle_Phone_number_callback',	
		'sc_utility_dashboard_options',		
		'general_settings_section',			
		array(								
			__( 'Phone Number.', 'sandbox' ),
		)
	);

	add_settings_field(	
		'Path_to_logo_image',						
		__( 'Path to logo image', 'sandbox' ),				
		'sandbox_toggle_Path_to_logo_image_callback',	
		'sc_utility_dashboard_options',		
		'general_settings_section',			
		array(								
			__( 'Path to logo image.', 'sandbox' ),
		)
	);

	add_settings_field(	
		'Enable_support_widget',						
		__( 'Enable support widget', 'sandbox' ),				
		'sandbox_toggle_Enable_support_widget_callback',	
		'sc_utility_dashboard_options',		
		'general_settings_section',			
		array(								
			__( 'Enable support widget', 'sandbox' ),
		)
	);

	add_settings_field(	
		'Hide_other_widget',						
		__( 'Hide other widget', 'sandbox' ),				
		'sandbox_toggle_Hide_other_widget_callback',	
		'sc_utility_dashboard_options',		
		'general_settings_section',			
		array(								
			__( 'Hide other widget', 'sandbox' ),
		)
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'sc_utility_dashboard_options',
		'sc_utility_dashboard_options'
	);
	
} // end sandbox_initialize_theme_options
add_action( 'admin_init', 'sandbox_initialize_theme_options' );

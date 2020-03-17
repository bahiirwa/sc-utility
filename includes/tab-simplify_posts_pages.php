<?php
/**
 * simplify_posts_pages settings
 */

 /**
 * Provides default values for the Input Options.
 */
function sc_utility_default_simplify_posts_pages() {
	
	$defaults = array(
		'input_example'		=>	'',
		'textarea_example'	=>	'',
		'checkbox_example'	=>	'',
		'radio_example'		=>	'',
		'time_options'		=>	'default'	
	);
	
	return apply_filters( 'sc_utility_default_simplify_posts_pages', $defaults );
	
} // end sc_utility_default_simplify_posts_pages


/**
 * Initializes the theme's input example by registering the Sections,
 * Fields, and Settings. This particular group of options is used to demonstration
 * validation and sanitization.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function sc_utility_initialize_simplify_posts_pages() {

	if( false == get_option( 'sc_utility_simplify_posts_pages' ) ) {	
		add_option( 'sc_utility_simplify_posts_pages', apply_filters( 'sc_utility_default_simplify_posts_pages', sc_utility_default_simplify_posts_pages() ) );
	} // end if

	add_settings_section(
		'simplify_posts_pages_section',
		__( 'Simplify Posts & Pages', 'sandbox' ),
		'sandbox_simplify_posts_pages_callback',
		'sc_utility_simplify_posts_pages'
	);
	
	add_settings_field(	
		'Input Element',						
		__( 'Input Element', 'sandbox' ),							
		'sandbox_input_element_callback',	
		'sc_utility_simplify_posts_pages',	
		'simplify_posts_pages_section'			
	);
	
	add_settings_field(	
		'Textarea Element',						
		__( 'Textarea Element', 'sandbox' ),							
		'sandbox_textarea_element_callback',	
		'sc_utility_simplify_posts_pages',	
		'simplify_posts_pages_section'			
	);
	
	add_settings_field(
		'Checkbox Element',
		__( 'Checkbox Element', 'sandbox' ),
		'sandbox_checkbox_element_callback',
		'sc_utility_simplify_posts_pages',
		'simplify_posts_pages_section'
	);
	
	add_settings_field(
		'Radio Button Elements',
		__( 'Radio Button Elements', 'sandbox' ),
		'sandbox_radio_element_callback',
		'sc_utility_simplify_posts_pages',
		'simplify_posts_pages_section'
	);
	
	add_settings_field(
		'Select Element',
		__( 'Select Element', 'sandbox' ),
		'sandbox_select_element_callback',
		'sc_utility_simplify_posts_pages',
		'simplify_posts_pages_section'
	);
	
	register_setting(
		'sc_utility_simplify_posts_pages',
		'sc_utility_simplify_posts_pages',
		'sc_utility_validate_simplify_posts_pages'
	);

} // end sc_utility_initialize_simplify_posts_pages
add_action( 'admin_init', 'sc_utility_initialize_simplify_posts_pages' );

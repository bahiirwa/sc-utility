<?php
/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the General Options page. 
 *
 * It's called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function sandbox_dashboard_options_callback() {
	echo '<p>' . __( 'Select which areas of content you wish to display.', 'sandbox' ) . '</p>';
} // end sandbox_dashboard_options_callback

/**
 * This function provides a simple description for the Social Options page. 
 *
 * It's called from the 'sc_utility_initialize_admin_menu' function by being passed as a parameter
 * in the add_settings_section function.
 */
function sandbox_admin_menu_callback() {
	echo '<p>' . __( 'Provide the URL to the social networks you\'d like to display.', 'sandbox' ) . '</p>';
} // end sandbox_dashboard_options_callback

/**
 * This function provides a simple description for the Simplify Posts & Pages page.
 *
 * It's called from the 'sc_utility_initialize_simplify_posts_pages_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function sandbox_simplify_posts_pages_callback() {
	echo '<p>' . __( 'Provides examples of the five basic element types.', 'sandbox' ) . '</p>';
} // end sandbox_dashboard_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array or arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function sandbox_toggle_Email_address_callback($args) {
	
	$options = get_option('sc_utility_dashboard_options');
	echo '<input type="text" id="Email_address" name="sc_utility_dashboard_options[Email_address]" value="' . $options['Email_address'] . '" />';
	
} // end sandbox_toggle_sandbox_toggle_Email_address_callback_callback

function sandbox_toggle_title_callback($args) {

	$options = get_option('sc_utility_dashboard_options');
	echo '<input type="text" id="title" name="sc_utility_dashboard_options[title]" value="' . $options['title'] . '" />';

} // end sandbox_toggle_content_callback

function sandbox_toggle_Phone_number_callback($args) {
	
	$options = get_option('sc_utility_dashboard_options');
	echo '<input type="text" id="Phone_number" name="sc_utility_dashboard_options[Phone_number]" value="' . $options['Phone_number'] . '" />';

} // end sandbox_toggle_footer_callback

function sandbox_toggle_Path_to_logo_image_callback($args) {
	
	$options = get_option('sc_utility_dashboard_options');
	echo '<input type="text" id="Path_to_logo_image" name="sc_utility_dashboard_options[Path_to_logo_image]" value="' . $options['Path_to_logo_image'] . '" />';
	
} // end sandbox_toggle_footer_callback
	
function sandbox_toggle_Enable_support_widget_callback($args) {
	
	$options = get_option('sc_utility_dashboard_options');
	
	$html = '<input type="checkbox" id="Enable_support_widget" name="sc_utility_dashboard_options[Enable_support_widget]" value="1" ' . checked( 1, isset( $options['Enable_support_widget'] ) ? $options['Enable_support_widget'] : 0, false ) . '/>'; 
	$html .= '<label for="Enable support widget">&nbsp;'  . $args[0] . '</label>'; 
	
	echo $html;
	
} // end sandbox_toggle_footer_callback

function sandbox_toggle_Hide_other_widget_callback($args) {
	
	$options = get_option('sc_utility_dashboard_options');
	
	$html = '<input type="checkbox" id="Hide_other_widget" name="sc_utility_dashboard_options[Hide_other_widget]" value="1" ' . checked( 1, isset( $options['Hide_other_widget'] ) ? $options['Hide_other_widget'] : 0, false ) . '/>'; 
	$html .= '<label for="Hide other widget">&nbsp;'  . $args[0] . '</label>'; 
	
	echo $html;
	
} // end sandbox_toggle_footer_callback

function sandbox_twitter_callback() {
	
	// First, we read the social options collection
	$options = get_option( 'sc_utility_admin_menu' );
	
	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$url = '';
	if( isset( $options['twitter'] ) ) {
		$url = esc_url( $options['twitter'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="twitter" name="sc_utility_admin_menu[twitter]" value="' . $url . '" />';
	
} // end sandbox_twitter_callback

function sandbox_facebook_callback() {
	
	$options = get_option( 'sc_utility_admin_menu' );
	
	$url = '';
	if( isset( $options['facebook'] ) ) {
		$url = esc_url( $options['facebook'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="facebook" name="sc_utility_admin_menu[facebook]" value="' . $url . '" />';
	
} // end sandbox_facebook_callback

function sandbox_googleplus_callback() {
	
	$options = get_option( 'sc_utility_admin_menu' );
	
	$url = '';
	if( isset( $options['googleplus'] ) ) {
		$url = esc_url( $options['googleplus'] );
	} // end if
	
	// Render the output
	echo '<input type="text" id="googleplus" name="sc_utility_admin_menu[googleplus]" value="' . $url . '" />';
	
} // end sandbox_googleplus_callback

function sandbox_input_element_callback() {
	
	$options = get_option( 'sc_utility_simplify_posts_pages' );
	
	// Render the output
	echo '<input type="text" id="input_example" name="sc_utility_simplify_posts_pages[input_example]" value="' . $options['input_example'] . '" />';
	
} // end sandbox_input_element_callback

function sandbox_textarea_element_callback() {
	
	$options = get_option( 'sc_utility_simplify_posts_pages' );
	
	// Render the output
	echo '<textarea id="textarea_example" name="sc_utility_simplify_posts_pages[textarea_example]" rows="5" cols="50">' . $options['textarea_example'] . '</textarea>';
	
} // end sandbox_textarea_element_callback

function sandbox_checkbox_element_callback() {

	$options = get_option( 'sc_utility_simplify_posts_pages' );
	
	$html = '<input type="checkbox" id="checkbox_example" name="sc_utility_simplify_posts_pages[checkbox_example]" value="1"' . checked( 1, $options['checkbox_example'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="checkbox_example">This is an example of a checkbox</label>';
	
	echo $html;

} // end sandbox_checkbox_element_callback

function sandbox_radio_element_callback() {

	$options = get_option( 'sc_utility_simplify_posts_pages' );
	
	$html = '<input type="radio" id="radio_example_one" name="sc_utility_simplify_posts_pages[radio_example]" value="1"' . checked( 1, $options['radio_example'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="radio_example_one">Option One</label>';
	$html .= '&nbsp;';
	$html .= '<input type="radio" id="radio_example_two" name="sc_utility_simplify_posts_pages[radio_example]" value="2"' . checked( 2, $options['radio_example'], false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="radio_example_two">Option Two</label>';
	
	echo $html;

} // end sandbox_radio_element_callback

function sandbox_select_element_callback() {

	$options = get_option( 'sc_utility_simplify_posts_pages' );
	
	$html = '<select id="time_options" name="sc_utility_simplify_posts_pages[time_options]">';
		$html .= '<option value="default">' . __( 'Select a time option...', 'sandbox' ) . '</option>';
		$html .= '<option value="never"' . selected( $options['time_options'], 'never', false) . '>' . __( 'Never', 'sandbox' ) . '</option>';
		$html .= '<option value="sometimes"' . selected( $options['time_options'], 'sometimes', false) . '>' . __( 'Sometimes', 'sandbox' ) . '</option>';
		$html .= '<option value="always"' . selected( $options['time_options'], 'always', false) . '>' . __( 'Always', 'sandbox' ) . '</option>';	$html .= '</select>';
	
	echo $html;

} // end sandbox_radio_element_callback

/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function sc_utility_sanitize_admin_menu( $input ) {
	
	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	
	
	} // end foreach
	
	// Return the new collection
	return apply_filters( 'sc_utility_sanitize_admin_menu', $output, $input );

} // end sc_utility_sanitize_admin_menu

function sc_utility_validate_simplify_posts_pages( $input ) {

	// Create our array for storing the validated options
	$output = array();
	
	// Loop through each of the incoming options
	foreach( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			
		} // end if
		
	} // end foreach
	
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'sc_utility_validate_simplify_posts_pages', $output, $input );

} // end sc_utility_validate_simplify_posts_pages

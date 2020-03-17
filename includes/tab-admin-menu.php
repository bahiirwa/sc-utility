<?php

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level 
 * 'Sandbox Theme' menu.
 */
function sandbox_example_theme_menu() {

	add_theme_page(
		'SC Utility', 					// The title to be displayed in the browser window for this page.
		'SC Utility',					// The text to be displayed for this menu item
		'administrator',					// Which type of users can see this menu item
		'sc_utility_options',			// The unique ID - that is, the slug - for this menu item
		'sc_utility_display'				// The name of the function to call when rendering this menu's page
	);
	
	add_menu_page(
		'SC Utility',					// The value used to populate the browser's title bar when the menu page is active
		'SC Utility',					// The text of the menu in the administrator's sidebar
		'administrator',					// What roles are able to access the menu
		'sc_utility_menu',				// The ID used to bind submenu items to this menu 
		'sc_utility_display'				// The callback function used to render this menu
	);
	
	add_submenu_page(
		'sc_utility_menu',				// The ID of the top-level menu page to which this submenu item belongs
		__( 'Dashboard Options', 'sandbox' ),			// The value used to populate the browser's title bar when the menu page is active
		__( 'Dashboard Options', 'sandbox' ),					// The label of this submenu item displayed in the menu
		'administrator',					// What roles are able to access this submenu item
		'sc_utility_dashboard_options',	// The ID used to represent this submenu item
		'sc_utility_display'				// The callback function used to render the options for this submenu item
	);
	
	add_submenu_page(
		'sc_utility_menu',
		__( 'Admin Menu', 'sandbox' ),
		__( 'Admin Menu', 'sandbox' ),
		'administrator',
		'sc_utility_admin_menu',
		create_function( null, 'sc_utility_display( "admin_menu" );' )
	);
	
	add_submenu_page(
		'sc_utility_menu',
		__( 'Simplify Posts & Pages', 'sandbox' ),
		__( 'Simplify Posts & Pages', 'sandbox' ),
		'administrator',
		'sc_utility_simplify_posts_pages',
		create_function( null, 'sc_utility_display( "simplify_posts_pages" );' )
	);


} // end sandbox_example_theme_menu

add_action( 'admin_menu', 'sandbox_example_theme_menu' );
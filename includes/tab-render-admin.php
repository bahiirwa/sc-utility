<?php

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function sc_utility_display( $active_tab = '' ) {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Simply Computing Utility', 'sandbox' ); ?></h2>
		<?php settings_errors(); ?>
		
		<?php if( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} else if( $active_tab == 'admin_menu' ) {
			$active_tab = 'admin_menu';
		} else if( $active_tab == 'simplify_posts_pages' ) {
			$active_tab = 'simplify_posts_pages';
		} else {
			$active_tab = 'dashboard_options';
		} // end if/else ?>
		
		<h2 class="nav-tab-wrapper">
			<a href="?page=sc_utility_options&tab=dashboard_options" class="nav-tab <?php echo $active_tab == 'dashboard_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Dashboard', 'sandbox' ); ?></a>
			<a href="?page=sc_utility_options&tab=admin_menu" class="nav-tab <?php echo $active_tab == 'admin_menu' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Admin Menu', 'sandbox' ); ?></a>
			<a href="?page=sc_utility_options&tab=simplify_posts_pages" class="nav-tab <?php echo $active_tab == 'simplify_posts_pages' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Simplify Posts & Pages', 'sandbox' ); ?></a>
		</h2>
		
		<form method="post" action="options.php">
			<?php
			
				if( $active_tab == 'dashboard_options' ) {
				
					settings_fields( 'sc_utility_dashboard_options' );
					do_settings_sections( 'sc_utility_dashboard_options' );
					
				} elseif( $active_tab == 'admin_menu' ) {
				
					settings_fields( 'sc_utility_admin_menu' );
					do_settings_sections( 'sc_utility_admin_menu' );
					
				} else {
				
					settings_fields( 'sc_utility_simplify_posts_pages' );
					do_settings_sections( 'sc_utility_simplify_posts_pages' );
					
				} // end if/else
				
				submit_button();
			
			?>
		</form>
		
	</div><!-- /.wrap -->
<?php
} // end sc_utility_display

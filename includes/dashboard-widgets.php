<?php

/*
 * Add a dashboard widget giving contact details for support.
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
   Contact the developers at ' . $options['title'] . ' by <a href="mailto:' . $options['email'] . '" target=_blank"><u>email</u></a>
   or phone ' . $options['phone'] . '.<p>';

  }


 /**
 * Add a dashboard widget to show recent messages when storing contact messages.
 */

    add_action('wp_dashboard_setup', 'add_sc_recent_message_display' );

    function add_sc_recent_message_display() {

        $options = get_option('sc_utility_settings');

        if (isset($options['messages_saved']) == 1) {    

    	  	wp_add_dashboard_widget( 'sc_recent_message_display', __( 'Recent Messages' ), 'sc_recent_message_display' );

    	  }
    	}

    function sc_recent_message_display() {
            ?>
              <ol>
                <?php
                  global $post;
                  $args = array( 'numberposts' => 10, 'post_type' => array( 'messages' ) );
                  $myposts = get_posts( $args );
                    foreach( $myposts as $post ) :  setup_postdata($post); ?>
                      <li><?php the_title(); ?></li>
                    <?php endforeach; ?>
              </ol>
            <?php
        }

/**
* Add more useful information to the "At a Glance" widget on the dashboard
*/   

    add_filter( 'dashboard_glance_items', 'sc_add_dashboard_glance_items', 10, 1 );  

    function sc_add_dashboard_glance_items( $items ) { 

        $phpversion = phpversion();

        $plugins = get_option('active_plugins');

            foreach($plugins as $key => &$value) {
            $value = explode('/',$value)[0]; // Folder name will be displayed
            }

        $pluginlist = implode('<br>', $plugins);  
        
        $items = array("</li></ul><hr><p><strong>PHP version: </strong>" . $phpversion ."</p><hr>
            <p><strong>Active plugins: </strong><br>" . $pluginlist ."</p><hr>");

        return $items; 

    };  

/*
 * Disable most of the other dashboard widgets.
 */

    add_action('admin_menu', 'sc_disable_dashboard_widgets');

      function sc_disable_dashboard_widgets() {

        $options = get_option('sc_utility_settings');

        if (isset($options['dashboard_widgets']) == 1) {

            remove_meta_box('dashboard_activity', 'dashboard', 'core');
            remove_meta_box('icwp-wpsf-dashboard_widget', 'dashboard', 'core');
            remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
            remove_action('welcome_panel', 'wp_welcome_panel');
            remove_meta_box('dashboard_primary', 'dashboard', 'core');
            remove_meta_box('dashboard_petitions', 'dashboard', 'core');
            remove_meta_box('wordfence_activity_report_widget', 'dashboard', 'core');
            add_filter( 'screen_options_show_screen', '__return_false' );

        }

    }

/**
* Removes the Help tab in the WP Admin
*/

    add_filter( 'contextual_help', 'sc_remove_help_tabs', 999, 3 );

    function sc_remove_help_tabs( $old_help, $screen_id, $screen ) {

        $screen->remove_help_tabs();
        return $old_help;

    }    

<?php
/*
Plugin Name: SC Utility
Plugin URI: 
Description: Add dashboard support widget, simplify the user interface
Version: 1.0
Author: Alan Coggins
Author URI: http://simplycomputing.com.au
License: GPLv2
*/

/*  Copyright 2019  Alan Coggins  (email : mail@simplycomputing.com.au)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


  defined( 'ABSPATH' ) or die( 'No direct access allowed!' );

  class MySettingsPage {

    /**
     * Holds the values to be used in the fields callbacks
     */

    private $options;

    /**
     * Start up
     */

    public function __construct() {

        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    
    }

    /**
     * Add options page
     */

    public function add_plugin_page() {

        $current_user = wp_get_current_user();

        $options = get_option('utility_settings');

        if ($options['security'] == '') {

            add_menu_page('Settings Admin', 'SC Utility', 'manage_options', 'sc-utility-settings', array( $this, 'create_admin_page' ));

        } else {

            if ($current_user->user_login === $options['security']) {

            add_menu_page('Settings Admin', 'SC Utility', 'manage_options', 'sc-utility-settings', array( $this, 'create_admin_page' ));

            }

        }
    }

    /**
     * Options page callback
     */

    public function create_admin_page() {

        // Set class property
        $this->options = get_option( 'utility_settings' );
        ?>

        <div class="wrap">
            <h1>Simply Computing Utility</h1>
            <style>
                .form-table th {padding: 10px 10px 0px 10px;}
                .form-table td {padding: 5px 10px 5px 10px;}
                h2 {margin: 25px 0 10px 0;}
            </style>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                submit_button();
                settings_fields( 'utility_settings_group' );
                do_settings_sections( 'sc-utility-settings' );
                submit_button();
            ?>
            </form>
        </div>
<?php
    }

    /**
     * Register and add settings
     */

    public function page_init()
    {        
        register_setting(
            'utility_settings_group', // Option group
            'utility_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        // Add section for displaying a support contact widget in dashboard

        add_settings_section('dashboard_widget', 'Dashboard widget information', '', 'sc-utility-settings');  

        add_settings_field('email', 'Email address:', array( $this, 'email_callback' ), 'sc-utility-settings', 'dashboard_widget' );      

        add_settings_field('title', 'Title:', array( $this, 'title_callback' ), 'sc-utility-settings', 'dashboard_widget');   

        add_settings_field('phone', 'Phone number:', array( $this, 'phone_callback' ), 'sc-utility-settings', 'dashboard_widget'); 

        add_settings_field('image', 'Path to logo image:', array( $this, 'image_callback' ), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('enable_widget', 'Enable support widget:', array( $this, 'enable_widget_callback' ), 'sc-utility-settings', 'dashboard_widget');         

        
        // Add section for settings to simplify admin side menu

        add_settings_section('setting_section_id', 'Simplify admin area side menu', array( $this, 'print_section_info' ), 'sc-utility-settings'); 

        add_settings_field('posts', 'Hide posts:', array( $this, 'posts_callback' ), 'sc-utility-settings', 'setting_section_id');  

        add_settings_field('media', 'Hide media:', array( $this, 'media_callback' ), 'sc-utility-settings', 'setting_section_id'); 

        add_settings_field('links', 'Hide links:', array( $this, 'links_callback' ), 'sc-utility-settings', 'setting_section_id');  

        add_settings_field('pages', 'Hide pages:', array( $this, 'pages_callback' ), 'sc-utility-settings', 'setting_section_id');  

        add_settings_field('comments', 'Hide comments:', array( $this, 'comments_callback' ), 'sc-utility-settings', 'setting_section_id');         

        add_settings_field('appearance', 'Hide appearance:', array( $this, 'appearance_callback' ), 'sc-utility-settings', 'setting_section_id'); 

        add_settings_field('plugins', 'Hide plugins:', array( $this, 'plugins_callback' ), 'sc-utility-settings', 'setting_section_id');  

        add_settings_field('users', 'Hide users:', array( $this, 'users_callback' ), 'sc-utility-settings', 'setting_section_id');          

        add_settings_field('tools', 'Hide tools:', array($this, 'tools_callback' ), 'sc-utility-settings', 'setting_section_id');      

        add_settings_field('settings', 'Hide settings:', array($this, 'settings_callback' ), 'sc-utility-settings', 'setting_section_id');


        // Add section to for including back some useful selected menu items from sub menus

        add_settings_section('add_item', 'Add individual menu items from the submenus', '', 'sc-utility-settings' );  

        add_settings_field('add_widgets', 'Add a widgets link:', array( $this, 'add_widgets_callback' ), 'sc-utility-settings', 'add_item'); 

        add_settings_field('add_menus', 'Add a menus link:', array( $this, 'add_menus_callback' ), 'sc-utility-settings', 'add_item');


        // Add section for settings to simplify pages and posts 

        add_settings_section('setting_section_id2', 'Simplify pages and posts', '', 'sc-utility-settings'); 

        add_settings_field('attributes', 'Hide page attributes:', array( $this, 'attributes_callback' ), 'sc-utility-settings', 'setting_section_id2');

         add_settings_field('categories', 'Hide categories:', array( $this, 'categories_callback' ), 'sc-utility-settings', 'setting_section_id2'); 

        add_settings_field('custom_fields', 'Hide custom fields:', array( $this, 'custom_fields_callback' ), 'sc-utility-settings', 'setting_section_id2');  

        add_settings_field('discussion', 'Hide discussion:', array( $this, 'discussion_callback' ), 'sc-utility-settings', 'setting_section_id2');          

        add_settings_field('slug', 'Hide slug:', array( $this, 'slug_callback' ), 'sc-utility-settings', 'setting_section_id2'); 

        add_settings_field('tags', 'Hide tags:', array( $this, 'tags_callback' ), 'sc-utility-settings', 'setting_section_id2');  

        add_settings_field('excerpts', 'Hide excerpts:', array( $this, 'excerpts_callback' ), 'sc-utility-settings', 'setting_section_id2');          

        add_settings_field('trackbacks', 'Hide trackbacks:', array( $this, 'trackbacks_callback' ), 'sc-utility-settings', 'setting_section_id2');

        add_settings_field('revisions', 'Hide revisions:', array( $this, 'revisions_callback' ), 'sc-utility-settings', 'setting_section_id2');

        add_settings_field('authors', 'Hide authors:', array( $this, 'authors_callback' ), 'sc-utility-settings', 'setting_section_id2');

        add_settings_field('format', 'Hide format:', array( $this, 'format_callback' ), 'sc-utility-settings', 'setting_section_id2');

        // Add section for other miscellaneous actions

        add_settings_section('miscellaneous', 'Simplify other areas', '', 'sc-utility-settings' );  

        add_settings_field('dashboard_widgets', 'Hide dashboard widgets:', array( $this, 'dashboard_widgets_callback' ), 'sc-utility-settings', 'miscellaneous'); 

        add_settings_field('top_admin', 'Hide top admin bar options:', array( $this, 'top_admin_callback' ), 'sc-utility-settings', 'miscellaneous');

 
        // Add section for security setting to restrict access to one admin user

        add_settings_section('security', 'Security', '', 'sc-utility-settings' );  

        add_settings_field('security', 'Lock utility to one admin user:<br/><small>(Careful! You can lock yourself out)</small>',
         array( $this, 'security_callback' ), 'sc-utility-settings', 'security');        

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */

    public function sanitize( $input ) {

        $new_input = array();

        if( isset( $input['email'] ) )
            $new_input['email'] = sanitize_text_field( $input['email'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        if( isset( $input['phone'] ) )
            $new_input['phone'] = sanitize_text_field( $input['phone'] );

        if( isset( $input['image'] ) )
            $new_input['image'] = sanitize_text_field( $input['image'] ); 

        if( isset( $input['enable_widget'] ) )
            $new_input['enable_widget'] = sanitize_text_field( $input['enable_widget'] );        

        if( isset( $input['posts'] ) )
            $new_input['posts'] = sanitize_text_field( $input['posts'] );

        if( isset( $input['media'] ) )
            $new_input['media'] = sanitize_text_field( $input['media'] );        

        if( isset( $input['links'] ) )
            $new_input['links'] = sanitize_text_field( $input['links'] ); 

        if( isset( $input['pages'] ) )
            $new_input['pages'] = sanitize_text_field( $input['pages'] );

        if( isset( $input['comments'] ) )
            $new_input['comments'] = sanitize_text_field( $input['comments'] );

        if( isset( $input['appearance'] ) )
            $new_input['appearance'] = sanitize_text_field( $input['appearance'] );

        if( isset( $input['plugins'] ) )
            $new_input['plugins'] = sanitize_text_field( $input['plugins'] );

        if( isset( $input['users'] ) )
            $new_input['users'] = sanitize_text_field( $input['users'] );        

        if( isset( $input['tools'] ) )
            $new_input['tools'] = sanitize_text_field( $input['tools'] );   

        if( isset( $input['settings'] ) )
            $new_input['settings'] = sanitize_text_field( $input['settings'] ); 

        if( isset( $input['add_widgets'] ) )
            $new_input['add_widgets'] = sanitize_text_field( $input['add_widgets'] );

        if( isset( $input['add_menus'] ) )
            $new_input['add_menus'] = sanitize_text_field( $input['add_menus'] );
                          
        if( isset( $input['attributes'] ) )
            $new_input['attributes'] = sanitize_text_field( $input['attributes'] );

        if( isset( $input['categories'] ) )
            $new_input['categories'] = sanitize_text_field( $input['categories'] );

        if( isset( $input['custom_fields'] ) )
            $new_input['custom_fields'] = sanitize_text_field( $input['custom_fields'] );        

        if( isset( $input['discussion'] ) )
            $new_input['discussion'] = sanitize_text_field( $input['discussion'] );   

        if( isset( $input['slug'] ) )
            $new_input['slug'] = sanitize_text_field( $input['slug'] );        

        if( isset( $input['tags'] ) )
            $new_input['tags'] = sanitize_text_field( $input['tags'] );        

        if( isset( $input['excerpts'] ) )
            $new_input['excerpts'] = sanitize_text_field( $input['excerpts'] );   

        if( isset( $input['trackbacks'] ) )
            $new_input['trackbacks'] = sanitize_text_field( $input['trackbacks'] );   

        if( isset( $input['revisions'] ) )
            $new_input['revisions'] = sanitize_text_field( $input['revisions'] );

        if( isset( $input['authors'] ) )
            $new_input['authors'] = sanitize_text_field( $input['authors'] );        

        if( isset( $input['format'] ) )
            $new_input['format'] = sanitize_text_field( $input['format'] ); 

        if( isset( $input['dashboard_widgets'] ) )
            $new_input['dashboard_widgets'] = sanitize_text_field( $input['dashboard_widgets'] );

        if( isset( $input['top_admin'] ) )
            $new_input['top_admin'] = sanitize_text_field( $input['top_admin'] );

        if( isset( $input['security'] ) )
            $new_input['security'] = sanitize_text_field( $input['security'] ); 

        return $new_input;

    }

    /** 
     * Get the settings option array and print values
     */

    public function email_callback() {
        printf(
            '<input type="text" id="email" name="utility_settings[email]" value="%s" size="40" />',
            isset( $this->options['email'] ) ? esc_attr( $this->options['email']) : ''
        );
    }

    public function title_callback() {
        printf(
            '<input type="text" id="title" name="utility_settings[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }

    public function phone_callback() {
        printf(
            '<input type="text" id="phone" name="utility_settings[phone]" value="%s" />',
            isset( $this->options['phone'] ) ? esc_attr( $this->options['phone']) : ''
        );
    }

    public function image_callback() {
        printf(
            '<input type="text" id="image" name="utility_settings[image]" value="%s" />',
            isset( $this->options['image'] ) ? esc_attr( $this->options['image']) : ''
        );
    }

    public function enable_widget_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['enable_widget'] ) ) $options['enable_widget'] = 0;
        $html = '<input type="checkbox" id="enable_widget" name="utility_settings[enable_widget]" value="1"' . checked( 1, $options['enable_widget'], false ) . '/>';
        echo $html;
    }    

    public function posts_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['posts'] ) ) $options['posts'] = 0;
        $html = '<input type="checkbox" id="posts" name="utility_settings[posts]" value="1"' . checked( 1, $options['posts'], false ) . '/>';
        echo $html;
    }

    public function media_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['media'] ) ) $options['media'] = 0;
        $html = '<input type="checkbox" id="media" name="utility_settings[media]" value="1"' . checked( 1, $options['media'], false ) . '/>';
        echo $html;
    }    

    public function links_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['links'] ) ) $options['links'] = 0;
        $html = '<input type="checkbox" id="links" name="utility_settings[links]" value="1"' . checked( 1, $options['links'], false ) . '/>';
        echo $html;
    }

    public function pages_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['pages'] ) ) $options['pages'] = 0;
        $html = '<input type="checkbox" id="pages" name="utility_settings[pages]" value="1"' . checked( 1, $options['pages'], false ) . '/>';
        echo $html;
    }

    public function comments_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['comments'] ) ) $options['comments'] = 0;
        $html = '<input type="checkbox" id="comments" name="utility_settings[comments]" value="1"' . checked( 1, $options['comments'], false ) . '/>';
        echo $html;
    }


    public function appearance_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['appearance'] ) ) $options['appearance'] = 0;
        $html = '<input type="checkbox" id="appearance" name="utility_settings[appearance]" value="1"' . checked( 1, $options['appearance'], false ) . '/>';
        echo $html;
    }

    public function plugins_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['plugins'] ) ) $options['plugins'] = 0;
        $html = '<input type="checkbox" id="plugins" name="utility_settings[plugins]" value="1"' . checked( 1, $options['plugins'], false ) . '/>';
        echo $html;
    }

    public function users_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['users'] ) ) $options['users'] = 0;
        $html = '<input type="checkbox" id="users" name="utility_settings[users]" value="1"' . checked( 1, $options['users'], false ) . '/>';
        echo $html;
    }    

    public function tools_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['tools'] ) ) $options['tools'] = 0;
        $html = '<input type="checkbox" id="tools" name="utility_settings[tools]" value="1"' . checked( 1, $options['tools'], false ) . '/>';
        echo $html;
    }    

    public function settings_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['settings'] ) ) $options['settings'] = 0;
        $html = '<input type="checkbox" id="settings" name="utility_settings[settings]" value="1"' . checked( 1, $options['settings'], false ) . '/>';
        echo $html;
    }    

    public function add_widgets_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['add_widgets'] ) ) $options['add_widgets'] = 0;
        $html = '<input type="checkbox" id="add_widgets" name="utility_settings[add_widgets]" value="1"' . checked( 1, $options['add_widgets'], false ) . '/>';
        echo $html;
    }     

    public function add_menus_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['add_menus'] ) ) $options['add_menus'] = 0;
        $html = '<input type="checkbox" id="add_menus" name="utility_settings[add_menus]" value="1"' . checked( 1, $options['add_menus'], false ) . '/>';
        echo $html;
    } 
    
    function attributes_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['attributes'] ) ) $options['attributes'] = 0;
        $html = '<input type="checkbox" id="attributes" name="utility_settings[attributes]" value="1"' . checked( 1, $options['attributes'], false ) . '/>';
        echo $html;
    }    

    public function categories_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['categories'] ) ) $options['categories'] = 0;
        $html = '<input type="checkbox" id="categories" name="utility_settings[categories]" value="1"' . checked( 1, $options['categories'], false ) . '/>';
        echo $html;
    }  

    public function custom_fields_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['custom_fields'] ) ) $options['custom_fields'] = 0;
        $html = '<input type="checkbox" id="custom_fields" name="utility_settings[custom_fields]" value="1"' . checked( 1, $options['custom_fields'], false ) . '/>';
        echo $html;
    }    

    public function discussion_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['discussion'] ) ) $options['discussion'] = 0;
        $html = '<input type="checkbox" id="discussion" name="utility_settings[discussion]" value="1"' . checked( 1, $options['discussion'], false ) . '/>';
        echo $html;
    }    

    public function slug_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['slug'] ) ) $options['slug'] = 0;
        $html = '<input type="checkbox" id="slug" name="utility_settings[slug]" value="1"' . checked( 1, $options['slug'], false ) . '/>';
        echo $html;
    }  

    public function tags_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['tags'] ) ) $options['tags'] = 0;
        $html = '<input type="checkbox" id="tags" name="utility_settings[tags]" value="1"' . checked( 1, $options['tags'], false ) . '/>';
        echo $html;
    }    

    public function excerpts_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['excerpts'] ) ) $options['excerpts'] = 0;
        $html = '<input type="checkbox" id="excerpts" name="utility_settings[excerpts]" value="1"' . checked( 1, $options['excerpts'], false ) . '/>';
        echo $html;
    }    

    public function trackbacks_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['trackbacks'] ) ) $options['trackbacks'] = 0;
        $html = '<input type="checkbox" id="trackbacks" name="utility_settings[trackbacks]" value="1"' . checked( 1, $options['trackbacks'], false ) . '/>';
        echo $html;
    } 

    public function revisions_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['revisions'] ) ) $options['revisions'] = 0;
        $html = '<input type="checkbox" id="revisions" name="utility_settings[revisions]" value="1"' . checked( 1, $options['revisions'], false ) . '/>';
        echo $html;
    }     

    public function authors_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['authors'] ) ) $options['authors'] = 0;
        $html = '<input type="checkbox" id="authors" name="utility_settings[authors]" value="1"' . checked( 1, $options['authors'], false ) . '/>';
        echo $html;
    }

    public function format_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['format'] ) ) $options['format'] = 0;
        $html = '<input type="checkbox" id="format" name="utility_settings[format]" value="1"' . checked( 1, $options['format'], false ) . '/>';
        echo $html;
    }

    public function dashboard_widgets_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['dashboard_widgets'] ) ) $options['dashboard_widgets'] = 0;
        $html = '<input type="checkbox" id="dashboard_widgets" name="utility_settings[dashboard_widgets]" value="1"' . checked( 1, $options['dashboard_widgets'], false ) . '/>';
        echo $html;
    }     

    public function top_admin_callback() {
        $options = get_option( 'utility_settings' );    
        if( !isset( $options['top_admin'] ) ) $options['top_admin'] = 0;
        $html = '<input type="checkbox" id="top_admin" name="utility_settings[top_admin]" value="1"' . checked( 1, $options['top_admin'], false ) . '/>';
        echo $html;
    } 

    public function security_callback() {
        printf(
            '<input type="text" id="security" name="utility_settings[security]" value="%s" />',
            isset( $this->options['security'] ) ? esc_attr( $this->options['security']) : ''
        );
    }    
}

   if( is_admin() )
   $my_settings_page = new MySettingsPage();


/*
 * Add a custom widget on the admin dashboard area giving contact details for support.
 */

    add_action('wp_dashboard_setup', 'custom_dashboard_widget');
   
    function custom_dashboard_widget() {

    global $wp_meta_boxes;

    $options = get_option('utility_settings');

    if (isset($options['enable_widget']) == 1)
        wp_add_dashboard_widget('custom_help_widget', $options['title'] . ' Support', 'custom_dashboard_support');

  }
   
  function custom_dashboard_support() {

    $options = get_option('utility_settings');

    $current_user = wp_get_current_user();

    echo '<p><img src="' . $options['image'] . '" style="width:80px;" /></p><p><b>Need help?</b>
   Contact the developers at ' . $options['title'] . ' by <a href="mailto:' . $options['email'] . '" target=_blank"><u>email</u></a> 
   or phone ' . $options['phone'] . '.<p>';

  }


/*
 * Remove items from admin menu.
 */  

    add_action('admin_menu', 'remove_admin_menus');

    function remove_admin_menus() {

        $options = get_option('utility_settings');

        if (isset($options['comments']) == 1)
            remove_menu_page('edit-comments.php'); // Comments
        if (isset($options['tools']) == 1)
            remove_menu_page('tools.php'); // Tools
        if (isset($options['appearance']) == 1)
            remove_menu_page('themes.php'); // Appearance
        if (isset($options['media']) == 1)
            remove_menu_page('upload.php'); // Media
        if (isset($options['links']) == 1)
            remove_menu_page('link-manager.php'); // Links
        if (isset($options['pages']) == 1)
            remove_menu_page('edit.php?post_type=page'); // Pages
        if (isset($options['plugins']) == 1)
            remove_menu_page('plugins.php'); // Plugins
        if (isset($options['posts']) == 1)
            remove_menu_page('edit.php'); // Posts
        if (isset($options['users']) == 1)
            remove_menu_page('users.php'); // Users
        if (isset($options['settings']) == 1)
            remove_menu_page('options-general.php'); // Settings

    }


/*
 * Remove items from post and pages.
 */  

    add_action('admin_init', 'remove_boxes');

    function remove_boxes() {

    $options = get_option('utility_settings');

        if (isset($options['attributes']) == 1)
            remove_meta_box('pageparentdiv', 'page', 'normal'); // Page attributes 
        if (isset($options['custom_fields']) == 1)
            remove_meta_box('postcustom', 'page', 'normal'); // Custom fields in pages
        if (isset($options['comments']) == 1) 
            remove_meta_box('commentsdiv', 'page', 'normal'); // Comments in pages
        if (isset($options['discussion']) == 1) 
            remove_meta_box('commentstatusdiv', 'page', 'normal'); // Discussions in pages
        if (isset($options['revisions']) == 1)
            remove_meta_box('revisionsdiv', 'page', 'normal'); //Revisions in pages
        if (isset($options['slug']) == 1)
            remove_meta_box('slugdiv', 'page', 'normal'); // Slugs in pages
        if (isset($options['revisionsdiv_page']) == 1)
            remove_meta_box('revisionsdiv', 'page', 'normal'); // Revisions in pages 
        if (isset($options['authors']) == 1)
            remove_meta_box('authordiv', 'page', 'normal'); // Authors in pages
        if (isset($options['format']) == 1)
            remove_meta_box('formatdiv', 'page', 'normal'); // Format in pages

        if (isset($options['custom_fields']) == 1)
            remove_meta_box('postcustom', 'post', 'normal'); // Custom fields in posts    
        if (isset($options['comments']) == 1)        
            remove_meta_box('commentsdiv', 'post', 'normal'); // Comments in posts
        if (isset($options['categories']) == 1)
            remove_meta_box('categorydiv', 'post', 'normal'); // Categories in posts     
        if (isset($options['discussion']) == 1)
            remove_meta_box('commentstatusdiv', 'post', 'normal'); // Discussion in posts
        if (isset($options['revisionsdiv_post']) == 1)
            remove_meta_box('revisionsdiv', 'post', 'normal'); // Revisions in posts
        if (isset($options['slug']) == 1)
            remove_meta_box('slugdiv', 'post', 'normal'); // Slugs in posts
        if (isset($options['tags']) == 1)
            remove_meta_box('tagsdiv-post_tag', 'post', 'normal'); // Tags in posts
        if (isset($options['excerpts']) == 1)
            remove_meta_box('postexcerpt', 'post', 'normal'); // Excerpts in posts
        if (isset($options['trackbacks']) == 1)
            remove_meta_box('trackbacksdiv', 'post', 'normal'); // Trackbacks in posts   
        if (isset($options['revisions']) == 1)
           remove_meta_box('revisionsdiv', 'post', 'normal'); // Revisions in posts
        if (isset($options['authors']) == 1)
            remove_meta_box('authordiv', 'post', 'normal'); // Authors in posts
        if (isset($options['format']) == 1)
            remove_meta_box('formatdiv', 'post', 'normal'); // Format in posts

    }


/*
 * Disable most of the main dashboard widgets.
 */    

    add_action('admin_menu', 'disable_dashboard_widgets');

    function disable_dashboard_widgets() {

        $options = get_option('utility_settings');

        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_activity', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_action('welcome_panel', 'wp_welcome_panel');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_primary', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('dashboard_petitions', 'dashboard', 'core');
        if (isset($options['dashboard_widgets']) == 1)
            remove_meta_box('wordfence_activity_report_widget', 'dashboard', 'core');


}


/*
 * Remove links from top admin bar.
 */

    add_action('admin_bar_menu', 'remove_toolbar_nodes', 999);

    function remove_toolbar_nodes($wp_admin_bar) {

        global $wp_admin_bar;

        $options = get_option('utility_settings');
    
        if (isset($options['top_admin']) == 1) {

        $wp_admin_bar->remove_menu('updates');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content'); 

    }      

  }


/*
 * Add 'widgets' link to side admin menu.
 */

    add_action('admin_menu', 'add_widgets_item');

    function add_widgets_item() {

        $options = get_option('utility_settings');

        if (isset($options['add_widgets']) == 1)
            add_menu_page(__('Widgets'), __('Widgets'), 'read', 'widgets.php');

    }


/*
 * Add 'menus' link to side admin menu.
 */

    add_action('admin_menu', 'add_menus_item');

    function add_menus_item() {

        $options = get_option('utility_settings');

        if (isset($options['add_menus']) == 1)
            add_menu_page(__('Menus'), __('Menus'), 'read', 'nav-menus.php');

  }


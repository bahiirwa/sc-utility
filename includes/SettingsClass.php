<?php
// Get callback functions class.
require_once(trailingslashit(plugin_dir_path(__FILE__)) . 'Callbacks.php');

/**
 * Settings Page Class
 */
class MySettingsPage extends CallbackFunctions {

    // Holds the values to be used in the fields callbacks
    private $options;
    
    public function __construct() {

        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));

    }

    /**
     * Add options page
     */
    public function add_plugin_page() {

        $current_user = wp_get_current_user();
        $admin_user = get_option('sc_admin_user');

        // If you get locked out, comment out this 'if' statement to remove the admin security check
        if ($current_user->user_login === $admin_user) {
            add_menu_page('Settings Admin', 'SC Utility', 'manage_options', 'sc-utility-settings', array($this, 'create_admin_page'), 'dashicons-admin-tools');
        }

    }

    /**
     * Options page callback
     */

    public function create_admin_page() {

        // Set class property
        $this->options = get_option('sc_utility_settings');
        ?>

        <div class="wrap">
            <h1>Simply Computing Utility</h1>
            <h4>This page is only available to admin user: <?php echo get_option('sc_admin_user') ?>.</h4>
            <style>
                .form-table th {padding: 10px 10px 0px 10px;}
                .form-table td {padding: 5px 10px 5px 10px;}
                h2 {margin: 25px 0 10px 0;}
            </style>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('utility_settings_group');
                do_settings_sections('sc-utility-settings');
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
        register_setting('utility_settings_group', 'sc_utility_settings', array($this, 'sanitize'));

        // Add section for displaying a support contact widget in dashboard
        add_settings_section('dashboard_widget', 'Dashboard widget information', '', 'sc-utility-settings');

        add_settings_field('email', 'Email address:', array($this, 'sc_email_callback'), 'sc-utility-settings', 'dashboard_widget');
        add_settings_field('title', 'Title:', array($this, 'sc_title_callback'), 'sc-utility-settings', 'dashboard_widget');
        add_settings_field('phone', 'Phone number:', array($this, 'sc_phone_callback'), 'sc-utility-settings', 'dashboard_widget');
        add_settings_field('image', 'Path to logo image:', array($this, 'sc_image_callback'), 'sc-utility-settings', 'dashboard_widget');
        add_settings_field('enable_widget', 'Enable support widget:', array($this, 'sc_enable_widget_callback'), 'sc-utility-settings', 'dashboard_widget');


        // Add section for settings to simplify admin side menu
        add_settings_section('setting_section_id', 'Simplify admin area side menu', '', 'sc-utility-settings');

        add_settings_field('posts', 'Hide posts:', array($this, 'sc_posts_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('media', 'Hide media:', array($this, 'sc_media_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('links', 'Hide links:', array($this, 'sc_links_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('pages', 'Hide pages:', array($this, 'sc_pages_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('comments', 'Hide comments:', array($this, 'sc_comments_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('appearance', 'Hide appearance:', array($this, 'sc_appearance_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('plugins', 'Hide plugins:', array($this, 'sc_plugins_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('users', 'Hide users:', array($this, 'sc_users_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('tools', 'Hide tools:', array($this, 'sc_tools_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('settings', 'Hide settings:', array($this, 'sc_settings_callback'), 'sc-utility-settings', 'setting_section_id');
        add_settings_field('shield', 'Hide Shield Security:', array($this, 'sc_shield_callback'), 'sc-utility-settings', 'setting_section_id');

        // Add section to for including back some useful selected menu items from sub menus
        add_settings_section('add_item', 'Add individual menu items from the submenus', '', 'sc-utility-settings');

        add_settings_field('add_widgets', 'Add a widgets link:', array($this, 'sc_add_widgets_callback'), 'sc-utility-settings', 'add_item');
        add_settings_field('add_menus', 'Add a menus link:', array($this, 'sc_add_menus_callback'), 'sc-utility-settings', 'add_item');


        // Add section for settings to simplify pages and posts
        add_settings_section('setting_section_id2', 'Simplify pages and posts', '', 'sc-utility-settings');

        add_settings_field('attributes', 'Hide page attributes:', array($this, 'sc_attributes_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('categories', 'Hide categories:', array($this, 'sc_categories_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('custom_fields', 'Hide custom fields:', array($this, 'sc_custom_fields_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('discussion', 'Hide discussion:', array($this, 'sc_discussion_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('slug', 'Hide slug:', array($this, 'sc_slug_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('tags', 'Hide tags:', array($this, 'sc_tags_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('excerpts', 'Hide excerpts:', array($this, 'sc_excerpts_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('trackbacks', 'Hide trackbacks:', array($this, 'sc_trackbacks_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('revisions', 'Hide revisions:', array($this, 'sc_revisions_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('authors', 'Hide authors:', array($this, 'sc_authors_callback'), 'sc-utility-settings', 'setting_section_id2');
        add_settings_field('format', 'Hide formats & layouts:', array($this, 'sc_format_callback'), 'sc-utility-settings', 'setting_section_id2');

        // Add section for other miscellaneous actions
        add_settings_section('miscellaneous', 'Simplify other areas', '', 'sc-utility-settings');
        
        add_settings_field('dashboard_widgets', 'Hide dashboard widgets:', array($this, 'sc_dashboard_widgets_callback'), 'sc-utility-settings', 'miscellaneous');
        add_settings_field('top_admin', 'Hide top admin bar options:', array($this, 'sc_top_admin_callback'), 'sc-utility-settings', 'miscellaneous');

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */

    public function sanitize($input) {

        $new_input = array();

        $new_input_array = array('email','title','phone','image','enable_widget','posts','media','links','pages','comments','appearance','plugins','users','tools','settings','shield','add_widgets','add_menus','attributes','categories','custom_fields','discussion','slug','tags','excerpts','trackbacks','revisions','authors','format','dashboard_widgets','top_admin');

        foreach($new_input_array as $new_input_field) {
            if(isset($input[$new_input_field]))
                $new_input[$new_input_field] = sanitize_text_field($input[$new_input_field]);
        }

        return $new_input;

    }

}

if(is_admin())
$my_settings_page = new MySettingsPage();
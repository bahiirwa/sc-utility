<?php

  class MySettingsPage {

    /**
     * Holds the values to be used in the fields callbacks
     */

    private $options;

    /**
     * Start up
     */

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
                submit_button();
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

        add_settings_section('dashboard_widget', 'Dashboard widgets', '', 'sc-utility-settings');

        add_settings_field('email', 'Email address:', array($this, 'sc_email_callback'), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('title', 'Title:', array($this, 'sc_title_callback'), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('phone', 'Phone number:', array($this, 'sc_phone_callback'), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('image', 'Path to logo image:', array($this, 'sc_image_callback'), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('enable_widget', 'Enable support widget:', array($this, 'sc_enable_widget_callback'), 'sc-utility-settings', 'dashboard_widget');

        add_settings_field('dashboard_widgets', 'Hide other widgets:', array($this, 'sc_dashboard_widgets_callback'), 'sc-utility-settings', 'dashboard_widget');


        // Add section for settings to simplify admin side menu

        add_settings_section('setting_section_id', 'Modify admin area side menu', '', 'sc-utility-settings');

        add_settings_field('posts', 'Hide posts:', array($this, 'sc_posts_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('media', 'Hide media:', array($this, 'sc_media_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('pages', 'Hide pages:', array($this, 'sc_pages_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('comments', 'Hide comments:', array($this, 'sc_comments_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('appearance', 'Hide appearance:', array($this, 'sc_appearance_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('plugins', 'Hide plugins:', array($this, 'sc_plugins_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('users', 'Hide users:', array($this, 'sc_users_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('tools', 'Hide tools:', array($this, 'sc_tools_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('settings', 'Hide settings:', array($this, 'sc_settings_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('shield', 'Hide security:', array($this, 'sc_shield_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('add_widgets', 'Add a widgets link:', array($this, 'sc_add_widgets_callback'), 'sc-utility-settings', 'setting_section_id');

        add_settings_field('add_menus', 'Add a menus link:', array($this, 'sc_add_menus_callback'), 'sc-utility-settings', 'setting_section_id');


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

        add_settings_field('feat_image', 'Hide featured image:', array($this, 'sc_feat_image_callback'), 'sc-utility-settings', 'setting_section_id2');

        // Add section for other miscellaneous actions

        add_settings_section('miscellaneous', 'Other settings', '', 'sc-utility-settings');

        add_settings_field('top_admin', 'Hide top admin bar options:', array($this, 'sc_top_admin_callback'), 'sc-utility-settings', 'miscellaneous');

        add_settings_field('revisions_saved', 'Number of revisions to save:', array($this, 'sc_revisions_saved_callback'), 'sc-utility-settings', 'miscellaneous');

        add_settings_field('messages_saved', 'Save contact messages:', array($this, 'sc_messages_saved_callback'), 'sc-utility-settings', 'miscellaneous');

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */

    public function sanitize($input) {

        $new_input = array();

        if(isset($input['email']))
            $new_input['email'] = sanitize_text_field($input['email']);

        if(isset($input['title']))
            $new_input['title'] = sanitize_text_field($input['title']);

        if(isset($input['phone']))
            $new_input['phone'] = sanitize_text_field($input['phone']);

        if(isset($input['image']))
            $new_input['image'] = sanitize_text_field($input['image']);

        if(isset($input['enable_widget']))
            $new_input['enable_widget'] = sanitize_text_field($input['enable_widget']);

        if(isset($input['posts']))
            $new_input['posts'] = sanitize_text_field($input['posts']);

        if(isset($input['media']))
            $new_input['media'] = sanitize_text_field($input['media']);

        if(isset($input['pages']))
            $new_input['pages'] = sanitize_text_field($input['pages']);

        if(isset($input['comments']))
            $new_input['comments'] = sanitize_text_field($input['comments']);

        if(isset($input['appearance']))
            $new_input['appearance'] = sanitize_text_field($input['appearance']);

        if(isset($input['plugins']))
            $new_input['plugins'] = sanitize_text_field($input['plugins']);

        if(isset($input['users']))
            $new_input['users'] = sanitize_text_field($input['users']);

        if(isset($input['tools']))
            $new_input['tools'] = sanitize_text_field($input['tools']);

        if(isset($input['settings']))
            $new_input['settings'] = sanitize_text_field($input['settings']);

        if(isset($input['shield']))
            $new_input['shield'] = sanitize_text_field($input['shield']);        

        if(isset($input['add_widgets']))
            $new_input['add_widgets'] = sanitize_text_field($input['add_widgets']);

        if(isset($input['add_menus']))
            $new_input['add_menus'] = sanitize_text_field($input['add_menus']);

        if(isset($input['attributes']))
            $new_input['attributes'] = sanitize_text_field($input['attributes']);

        if(isset($input['categories']))
            $new_input['categories'] = sanitize_text_field($input['categories']);

        if(isset($input['custom_fields']))
            $new_input['custom_fields'] = sanitize_text_field($input['custom_fields']);

        if(isset($input['discussion']))
            $new_input['discussion'] = sanitize_text_field($input['discussion']);

        if(isset($input['slug']))
            $new_input['slug'] = sanitize_text_field($input['slug']);

        if(isset($input['tags']))
            $new_input['tags'] = sanitize_text_field($input['tags']);

        if(isset($input['excerpts']))
            $new_input['excerpts'] = sanitize_text_field($input['excerpts']);

        if(isset($input['trackbacks']))
            $new_input['trackbacks'] = sanitize_text_field($input['trackbacks']);

        if(isset($input['revisions']))
            $new_input['revisions'] = sanitize_text_field($input['revisions']);

        if(isset($input['authors']))
            $new_input['authors'] = sanitize_text_field($input['authors']);

        if(isset($input['format']))
            $new_input['format'] = sanitize_text_field($input['format']);

        if(isset($input['dashboard_widgets']))
            $new_input['dashboard_widgets'] = sanitize_text_field($input['dashboard_widgets']);

        if(isset($input['top_admin']))
            $new_input['top_admin'] = sanitize_text_field($input['top_admin']);

        if(isset($input['revisions_saved']))
            $new_input['revisions_saved'] = sanitize_text_field($input['revisions_saved']); 

        if(isset($input['messages_saved']))
            $new_input['messages_saved'] = sanitize_text_field($input['messages_saved']);      

        if(isset($input['feat_image']))
            $new_input['feat_image'] = sanitize_text_field($input['feat_image']);      

        return $new_input;

    }

    /**
     * Get the settings option array and print values
     */

    public function sc_email_callback() {
        printf(

            '<input type="text" id="email" name="sc_utility_settings[email]" value="%s" size="40" />',

            isset($this->options['email']) ? esc_attr($this->options['email']) : '');
    }

    public function sc_title_callback() {
        printf(

            '<input type="text" id="title" name="sc_utility_settings[title]" value="%s" />',

            isset($this->options['title']) ? esc_attr($this->options['title']) : '');
    }

    public function sc_phone_callback() {
        printf(

            '<input type="text" id="phone" name="sc_utility_settings[phone]" value="%s" />',

            isset($this->options['phone']) ? esc_attr($this->options['phone']) : '');
    }

    public function sc_image_callback() {
        printf(

            '<input type="text" id="image" name="sc_utility_settings[image]" value="%s" />',

            isset($this->options['image']) ? esc_attr($this->options['image']) : '');
    }

    public function sc_enable_widget_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['enable_widget'])) $options['enable_widget'] = 0;
        $html = '<input type="checkbox" id="enable_widget" name="sc_utility_settings[enable_widget]" value="1"' . checked(1, $options['enable_widget'], false) . '/>';

        echo $html;
    }

    public function sc_posts_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['posts'])) $options['posts'] = 0;
        $html = '<input type="checkbox" id="posts" name="sc_utility_settings[posts]" value="1"' . checked(1, $options['posts'], false) . '/>';

        echo $html;
    }

    public function sc_media_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['media'])) $options['media'] = 0;
        $html = '<input type="checkbox" id="media" name="sc_utility_settings[media]" value="1"' . checked(1, $options['media'], false) . '/>';

        echo $html;
    }

    public function sc_pages_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['pages'])) $options['pages'] = 0;
        $html = '<input type="checkbox" id="pages" name="sc_utility_settings[pages]" value="1"' . checked(1, $options['pages'], false) . '/>';

        echo $html;
    }

    public function sc_comments_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['comments'])) $options['comments'] = 0;
        $html = '<input type="checkbox" id="comments" name="sc_utility_settings[comments]" value="1"' . checked(1, $options['comments'], false) . '/>';

        echo $html;
    }


    public function sc_appearance_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['appearance'])) $options['appearance'] = 0;
        $html = '<input type="checkbox" id="appearance" name="sc_utility_settings[appearance]" value="1"' . checked(1, $options['appearance'], false) . '/>';

        echo $html;
    }

    public function sc_plugins_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['plugins'])) $options['plugins'] = 0;
        $html = '<input type="checkbox" id="plugins" name="sc_utility_settings[plugins]" value="1"' . checked(1, $options['plugins'], false) . '/>';

        echo $html;
    }

    public function sc_users_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['users'])) $options['users'] = 0;
        $html = '<input type="checkbox" id="users" name="sc_utility_settings[users]" value="1"' . checked(1, $options['users'], false) . '/>';

        echo $html;
    }

    public function sc_tools_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['tools'])) $options['tools'] = 0;
        $html = '<input type="checkbox" id="tools" name="sc_utility_settings[tools]" value="1"' . checked(1, $options['tools'], false) . '/>';

        echo $html;
    }

    public function sc_settings_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['settings'])) $options['settings'] = 0;
        $html = '<input type="checkbox" id="settings" name="sc_utility_settings[settings]" value="1"' . checked(1, $options['settings'], false) . '/>';

        echo $html;
    }

    public function sc_shield_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['shield'])) $options['shield'] = 0;
        $html = '<input type="checkbox" id="shield" name="sc_utility_settings[shield]" value="1"' . checked(1, $options['shield'], false) . '/>';

        echo $html;
    }

    public function sc_add_widgets_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['add_widgets'])) $options['add_widgets'] = 0;
        $html = '<input type="checkbox" id="add_widgets" name="sc_utility_settings[add_widgets]" value="1"' . checked(1, $options['add_widgets'], false) . '/>';

        echo $html;
    }

    public function sc_add_menus_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['add_menus'])) $options['add_menus'] = 0;
        $html = '<input type="checkbox" id="add_menus" name="sc_utility_settings[add_menus]" value="1"' . checked(1, $options['add_menus'], false) . '/>';

        echo $html;
    }

    public function sc_attributes_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['attributes'])) $options['attributes'] = 0;
        $html = '<input type="checkbox" id="attributes" name="sc_utility_settings[attributes]" value="1"' . checked(1, $options['attributes'], false) . '/>';

        echo $html;
    }

    public function sc_categories_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['categories'])) $options['categories'] = 0;
        $html = '<input type="checkbox" id="categories" name="sc_utility_settings[categories]" value="1"' . checked(1, $options['categories'], false) . '/>';

        echo $html;
    }

    public function sc_custom_fields_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['custom_fields'])) $options['custom_fields'] = 0;
        $html = '<input type="checkbox" id="custom_fields" name="sc_utility_settings[custom_fields]" value="1"' . checked(1, $options['custom_fields'], false) . '/>';

        echo $html;
    }

    public function sc_discussion_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['discussion'])) $options['discussion'] = 0;
        $html = '<input type="checkbox" id="discussion" name="sc_utility_settings[discussion]" value="1"' . checked(1, $options['discussion'], false) . '/>';

        echo $html;
    }

    public function sc_slug_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['slug'])) $options['slug'] = 0;
        $html = '<input type="checkbox" id="slug" name="sc_utility_settings[slug]" value="1"' . checked(1, $options['slug'], false) . '/>';

        echo $html;
    }

    public function sc_tags_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['tags'])) $options['tags'] = 0;
        $html = '<input type="checkbox" id="tags" name="sc_utility_settings[tags]" value="1"' . checked(1, $options['tags'], false) . '/>';

        echo $html;
    }

    public function sc_excerpts_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['excerpts'])) $options['excerpts'] = 0;
        $html = '<input type="checkbox" id="excerpts" name="sc_utility_settings[excerpts]" value="1"' . checked(1, $options['excerpts'], false) . '/>';

        echo $html;
    }

    public function sc_trackbacks_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['trackbacks'])) $options['trackbacks'] = 0;
        $html = '<input type="checkbox" id="trackbacks" name="sc_utility_settings[trackbacks]" value="1"' . checked(1, $options['trackbacks'], false) . '/>';

        echo $html;
    }

    public function sc_revisions_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['revisions'])) $options['revisions'] = 0;
        $html = '<input type="checkbox" id="revisions" name="sc_utility_settings[revisions]" value="1"' . checked(1, $options['revisions'], false) . '/>';

        echo $html;
    }

    public function sc_authors_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['authors'])) $options['authors'] = 0;
        $html = '<input type="checkbox" id="authors" name="sc_utility_settings[authors]" value="1"' . checked(1, $options['authors'], false) . '/>';

        echo $html;
    }

    public function sc_format_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['format'])) $options['format'] = 0;
        $html = '<input type="checkbox" id="format" name="sc_utility_settings[format]" value="1"' . checked(1, $options['format'], false) . '/>';

        echo $html;
    }

    public function sc_feat_image_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['feat_image'])) $options['feat_image'] = 0;
        $html = '<input type="checkbox" id="feat_image" name="sc_utility_settings[feat_image]" value="1"' . checked(1, $options['feat_image'], false) . '/>';

        echo $html;
    }

    public function sc_dashboard_widgets_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['dashboard_widgets'])) $options['dashboard_widgets'] = 0;
        $html = '<input type="checkbox" id="dashboard_widgets" name="sc_utility_settings[dashboard_widgets]" value="1"' . checked(1, $options['dashboard_widgets'], false) . '/>';

        echo $html;
    }

    public function sc_top_admin_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['top_admin'])) $options['top_admin'] = 0;
        $html = '<input type="checkbox" id="top_admin" name="sc_utility_settings[top_admin]" value="1"' . checked(1, $options['top_admin'], false) . '/>';

        echo $html;
    }

    public function sc_revisions_saved_callback() {

        printf(

            '<input type="number" min="0" style="width: 50px;" id="revisions_saved" name="sc_utility_settings[revisions_saved]" value="%s" />',

            isset($this->options['revisions_saved']) ? esc_attr($this->options['revisions_saved']) : '');
    }    

    public function sc_messages_saved_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['messages_saved'])) $options['messages_saved'] = 0;
        $html = '<input type="checkbox" id="messages_saved" name="sc_utility_settings[messages_saved]" value="1"' . checked(1, $options['messages_saved'], false) . '/>';

        echo $html;
    }      

}

   if(is_admin())
   $my_settings_page = new MySettingsPage();

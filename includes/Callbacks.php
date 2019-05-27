<?php
/**
 * Callback functions for settings class
 * Get the settings option array and print values
 * 
 */
class CallbackFunctions {

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

    public function sc_links_callback() {

        $options = get_option('sc_utility_settings');
        if(!isset($options['links'])) $options['links'] = 0;
        $html = '<input type="checkbox" id="links" name="sc_utility_settings[links]" value="1"' . checked(1, $options['links'], false) . '/>';

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

}

<?php

/**
 * Remove Metaboxes in the generatepress theme
 */
function sc_remove_layout_meta_box() {

    $options = get_option('sc_utility_settings');

    if (isset($options['format']) == 1)
        remove_meta_box('generate_layout_options_meta_box', 'post', 'normal');

    if (isset($options['format']) == 1)
        remove_meta_box('generate_layout_options_meta_box', 'page', 'normal');
}

add_action('add_meta_boxes', 'sc_remove_layout_meta_box', 999 );
<?php
/*
 * Remove items from post and pages.
 */
add_action('admin_init', 'sc_remove_boxes');

function sc_remove_boxes() {

    $options = get_option('sc_utility_settings');

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
    if (isset($options['slug']) == 1)
        add_action( 'admin_head', 'hide_all_slugs'  ); // Slugs in posts and pages
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
* Hide slug editing areas at top and bottom of pages and posts.
*/
function hide_all_slugs() {
    echo '<style type="text/css"> #slugdiv, #edit-slug-box { display: none; }</style>';
}
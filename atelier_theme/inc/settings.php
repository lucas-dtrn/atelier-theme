<?php
// Theme Support
if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('atelier', get_template_directory() . '/languages');
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page('atelier Theme Options');
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function atelierwp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function atelierwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function atelierwp_custom_post($length) {
    return 40;
}


// Create the Custom Excerpts callback
function atelierwp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function atelier_blank_view_article($more) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'atelier') . '</a>';
}

// Disable SEO for development
function custom_noindex_setting() {
    if (defined('ROBOTS_ALLOWED') && ROBOTS_ALLOWED === false) {
        update_option('blog_public', 0); // Indexierung deaktivieren
    } else {
        update_option('blog_public', 1); // Indexierung aktivieren
    }
}

add_action('init', 'custom_noindex_setting'); // Disable SEO for development
add_action('init', 'atelierwp_pagination'); // Add our HTML5 Pagination
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'atelier_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
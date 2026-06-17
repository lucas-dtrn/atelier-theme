<?php
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Produkt Filter', 'wvnderlab'),
        'description' => __('Description for this widget-area...', 'wvnderlab'),
        'id' => 'product-filters',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
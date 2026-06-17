<?php
if (!isset($content_width)) {
    $content_width = 900;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
add_filter('avatar_defaults', 'ateliergravatar'); // Custom Gravatar in Settings > Discussion
function ateliergravatar($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/assets/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "atelier Avatar";
    return $avatar_defaults;
}

add_filter('wp_nav_menu_objects', 'my_menu_class');
function my_menu_class($menu) {
    $level = 0;
    $stack = array('0');
    foreach ($menu as $key => $item) {
        while ($item->menu_item_parent != array_pop($stack)) {
            $level--;
        }
        $level++;
        $stack[] = $item->menu_item_parent;
        $stack[] = $item->ID;
        $menu[$key]->classes[] = 'level-' . ($level - 1);
    }
    return $menu;
}

// Disable Image Links
add_action('after_setup_theme', 'default_attachment_display_settings');
function default_attachment_display_settings() {
    update_option('image_default_link_type', 'none');
}

// Add Custom Image Sizes
add_action('after_setup_theme', 'register_custom_image_sizes');
function register_custom_image_sizes() {
    if (!current_theme_supports('post-thumbnails')) {
        add_theme_support('post-thumbnails');
    }
}

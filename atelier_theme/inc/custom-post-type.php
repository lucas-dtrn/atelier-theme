<?php
/*------------------------------------*\
Custom Post Types
\*------------------------------------*/
add_action('init', 'create_post_type_atelier'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'create_post_types_kunstangebote'); // Add our HTML5 Blank Custom Post Type

function create_post_type_atelier() {

    register_taxonomy('course_days', array('books'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Wochentage', 'taxonomy general name'),
            'singular_name' => _x('Wochentag', 'taxonomy singular name'),
            'search_items' => __('Wochentage suchen'),
            'all_items' => __('Alle Wochentage'),
            'parent_item' => __('Eltern Wochentag'),
            'parent_item_colon' => __('Eltern Wochentag:'),
            'edit_item' => __('Wochentag bearbeiten'),
            'update_item' => __('Wochentag aktualisieren'),
            'add_new_item' => __('Neuen Wochentag erstellen'),
            'new_item_name' => __('Neuer Wochentag Name'),
            'menu_name' => __('Wochentage'),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'wochentag'),

        // disable archive, single and seo indexing
        "public" => false,
        "has_archive" => false,
        "publicly_queryable" => false,
    ));

    register_taxonomy('product_badge', 'product', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Badges', 'taxonomy general name'),
            'singular_name' => _x('Badge', 'taxonomy singular name'),
            'search_items' => __('Badges suchen'),
            'all_items' => __('Alle Badges'),
            'parent_item' => __('Eltern Badge'),
            'parent_item_colon' => __('Eltern Badge:'),
            'edit_item' => __('Badge bearbeiten'),
            'update_item' => __('Badge aktualisieren'),
            'add_new_item' => __('Neuen Badge erstellen'),
            'new_item_name' => __('Neuer Badge Name'),
            'menu_name' => __('Badges'),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));
    register_taxonomy_for_object_type('product_badge', 'product');

    register_taxonomy('course_time', 'termin', array(
        'labels' => array(
            'name' => _x('Kurszeit', 'taxonomy general name'),
            'singular_name' => _x('Kurszeit', 'taxonomy singular name'),
            'search_items' => __('Kurszeit suchen'),
            'all_items' => __('Alle Kurszeit'),
            'parent_item' => __('Eltern Kurszeit'),
            'parent_item_colon' => __('Eltern Kurszeit:'),
            'edit_item' => __('Kurszeit bearbeiten'),
            'update_item' => __('Kurszeit aktualisieren'),
            'add_new_item' => __('Neuen Kurszeit erstellen'),
            'new_item_name' => __('Neuer Kurszeit Name'),
            'menu_name' => __('Kurszeit'),
        ),
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,

        // disable archive, single and seo indexing
        "public" => false,
        "has_archive" => false,
        "publicly_queryable" => false,
    ));
}

function create_post_types_kunstangebote() {
    /* ------------------------------------ */
    /* Kurse */
    /* ------------------------------------ */

    // Registriere den Post Type Kurse
    register_post_type(
        'course', // Register Custom Post Type
        array(
            'rewrite' => array('slug' => 'kurs'),
            'labels' => array(
                'name' => __('Kurse', 'atelier'), // Rename these to suit
                'singular_name' => __('Kurs', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Kurs erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Kurs bearbeiten', 'atelier'),
                'new_item' => __('Neuer Kurs', 'atelier'),
                'view' => __('Kurs ansehen', 'atelier'),
                'view_item' => __('Kurs ansehen', 'atelier'),
                'search_items' => __('Kurs suchen', 'atelier'),
                'not_found' => __('Keine Kurse gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Kurse im Papierkorb gefunden', 'atelier')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'taxonomies' => array(
                'course_date'
            ),
            'can_export' => true, // Allows export in Tools > Export
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-art'
        )
    );

    // Einstellungen für Kurse
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'post_id' => 'course_options',
            'page_title'    => __('Kurse: Einstellungen'),
            'menu_title'    => __('Kurse: Einstellungen'),
            'capability'    => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect'      => false
        ));
    }

    // Termine für Kurse
    register_post_type(
        'course_date', // Register Custom Post Type
        array(
            'rewrite' => array('slug' => 'kurstermin'),
            'labels' => array(
                'name' => __('Kurstermine', 'atelier'), // Rename these to suit
                'singular_name' => __('Kurstermin', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Kurstermin erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Kurstermin bearbeiten', 'atelier'),
                'new_item' => __('Neuer Kurstermin', 'atelier'),
                'view' => __('Kurstermin ansehen', 'atelier'),
                'view_item' => __('Kurstermin ansehen', 'atelier'),
                'search_items' => __('Kurstermin suchen', 'atelier'),
                'not_found' => __('Keine Kurstermine gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Kurstermine im Papierkorb gefunden', 'atelier')
            ),
            'supports' => array(
                'editor'
            ),
            'taxonomies' => array(
                'course_time'
            ),
            // Allows export in Tools > Export
            'can_export' => true,
            "public" => true,

            // disable archive, single and seo indexing
            "has_archive" => false,
            "publicly_queryable" => false,

        )
    );

    // Zeiten für Kurse
    register_taxonomy('course_time', array('course', 'course_date'), array(
        'labels' => array(
            'name' => _x('Kurszeiten', 'taxonomy general name'),
            'singular_name' => _x('Kurszeit', 'taxonomy singular name'),
            'search_items' => __('Kurszeit suchen'),
            'all_items' => __('Alle Kurszeiten'),
            'edit_item' => __('Kurszeit bearbeiten'),
            'update_item' => __('Kurszeit aktualisieren'),
            'add_new_item' => __('Neuen Kurszeit erstellen'),
            'new_item_name' => __('Neuer Kurszeit Name'),
            'menu_name' => __('Kurszeiten'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
    ));

    // Disable course_date single page
    add_action('template_redirect', 'wpse_128636_redirect_post');
    function wpse_128636_redirect_post() {
        if (is_singular('course_date')) :
            wp_redirect(home_url(), 301);
            exit;
        endif;
    }

    /* ------------------------------------ */
    /* NOTE: Workshops */
    /* ------------------------------------ */

    // Registriere den Post Type Workshops
    register_post_type(
        'workshop', // Register Custom Post Type
        array(
            // 'rewrite' => array('slug' => 'workshop'),
            'labels' => array(
                'name' => __('Workshops', 'atelier'), // Rename these to suit
                'singular_name' => __('Workshop', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Workshop erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Workshop bearbeiten', 'atelier'),
                'new_item' => __('Neuer Workshop', 'atelier'),
                'view' => __('Workshop ansehen', 'atelier'),
                'view_item' => __('Workshop ansehen', 'atelier'),
                'search_items' => __('Workshop suchen', 'atelier'),
                'not_found' => __('Keine Workshops gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Workshops im Papierkorb gefunden', 'atelier')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail',
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-art'
        )
    );
    // Einsellungen für Workshops
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'post_id'     => 'workshop_options',
            'page_title'    => __('Workshops: Einstellungen'),
            'menu_title'    => __('Workshops: Einstellungen'),
            'capability'    => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect'      => false
        ));
    }
    // Termine für Workshops
    register_post_type(
        'workshop_date', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Workshoptermine', 'atelier'), // Rename these to suit
                'singular_name' => __('Workshoptermin', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Workshoptermin erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Workshoptermin bearbeiten', 'atelier'),
                'new_item' => __('Neuer Workshoptermin', 'atelier'),
                'view' => __('Workshoptermin ansehen', 'atelier'),
                'view_item' => __('Workshoptermin ansehen', 'atelier'),
                'search_items' => __('Workshoptermin suchen', 'atelier'),
                'not_found' => __('Keine Workshoptermine gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Workshoptermine im Papierkorb gefunden', 'atelier')
            ),
            'supports' => array(
                'editor'
            ),
            // Allows export in Tools > Export
            'can_export' => true,
            "public" => true,

            // disable archive, single and seo indexing
            "has_archive" => false,
            "publicly_queryable" => false,

        )
    );

    /* ------------------------------------ */
    /* NOTE: Geburtstage */
    /* ------------------------------------ */

    // Registriere den Post Type Geburtstage
    register_post_type(
        'birthday', // Register Custom Post Type
        array(
            'rewrite' => array('slug' => 'kindergeburtstag'),
            'labels' => array(
                'name' => __('Kindergeburtstage', 'atelier'), // Rename these to suit
                'singular_name' => __('Kindergeburtstag', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Kindergeburtstag erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Kindergeburtstag bearbeiten', 'atelier'),
                'new_item' => __('Neuer Kindergeburtstag', 'atelier'),
                'view' => __('Kindergeburtstag ansehen', 'atelier'),
                'view_item' => __('Kindergeburtstag ansehen', 'atelier'),
                'search_items' => __('Kindergeburtstag suchen', 'atelier'),
                'not_found' => __('Keine Kindergeburtstage gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Kindergeburtstage im Papierkorb gefunden', 'atelier')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-buddicons-community'
        )
    );

    // Einstellungen für Geburtstage
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'post_id'     => 'birthday_options',
            'page_title'    => __('Kindergeburtstage: Einstellungen'),
            'menu_title'    => __('Kindergeburtstage: Einstellungen'),
            'capability'    => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect'      => false
        ));
    }

    /* ------------------------------------ */
    /* NOTE: Kunstevents */
    /* ------------------------------------ */

    // Registriere den Post Type Kunstevents
    register_post_type(
        'event', // Register Custom Post Type
        array(
            'rewrite' => array('slug' => 'kunstevent'),
            'labels' => array(
                'name' => __('Kunstevents', 'atelier'), // Rename these to suit
                'singular_name' => __('Kunstevent', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neues Kunstevent erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Kunstevent bearbeiten', 'atelier'),
                'new_item' => __('Neues Kunstevent', 'atelier'),
                'view' => __('Kunstevent ansehen', 'atelier'),
                'view_item' => __('Kunstevent ansehen', 'atelier'),
                'search_items' => __('Kunstevent suchen', 'atelier'),
                'not_found' => __('Keine Kunstevents gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Kunstevents im Papierkorb gefunden', 'atelier')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-art'
        )
    );

    // Einstellungen für Kunstevents
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'post_id'     => 'event_options',
            'page_title'    => __('Kunstevents: Einstellungen'),
            'menu_title'    => __('Kunstevents: Einstellungen'),
            'capability'    => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect'      => false
        ));
    }

    /* ------------------------------------ */
    /* NOTE: Ferienworkshops */
    /* ------------------------------------ */

    // Registriere den Post Type Ferienworkshops
    register_post_type(
        'holiday_workshop', // Register Custom Post Type
        array(
            'rewrite' => array('slug' => 'ferienprogramm'),
            'labels' => array(
                'name' => __('Ferienworkshops', 'atelier'), // Rename these to suit
                'singular_name' => __('Ferienworkshop', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Ferienworkshop erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Ferienworkshop bearbeiten', 'atelier'),
                'new_item' => __('Neuer Ferienworkshop', 'atelier'),
                'view' => __('Ferienworkshop ansehen', 'atelier'),
                'view_item' => __('Ferienworkshop ansehen', 'atelier'),
                'search_items' => __('Ferienworkshop suchen', 'atelier'),
                'not_found' => __('Keine Ferienworkshops gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Ferienworkshops im Papierkorb gefunden', 'atelier')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export' => true, // Allows export in Tools > Export
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-art'
        )
    );

    // Einstellungen für Ferienworkshops
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'post_id'     => 'holiday_workshop_options',
            'page_title'    => __('Ferienworkshops: Einstellungen'),
            'menu_title'    => __('Ferienworkshops: Einstellungen'),
            'capability'    => 'edit_posts',
            'icon_url' => 'dashicons-admin-generic',
            'redirect'      => false
        ));
    }

    // Termine für Ferienworkshops
    register_post_type(
        'h_workshop_date', // Register Custom Post Type
        array(
            'labels' => array(
                'name' => __('Ferienworkshoptermine', 'atelier'), // Rename these to suit
                'singular_name' => __('Ferienworkshoptermin', 'atelier'),
                'add_new' => __('Neu erstellen', 'atelier'),
                'add_new_item' => __('Neuen Ferienworkshoptermin erstellen', 'atelier'),
                'edit' => __('Bearbeiten', 'atelier'),
                'edit_item' => __('Ferienworkshoptermin bearbeiten', 'atelier'),
                'new_item' => __('Neuer Ferienworkshoptermin', 'atelier'),
                'view' => __('Ferienworkshoptermin ansehen', 'atelier'),
                'view_item' => __('Ferienworkshoptermin ansehen', 'atelier'),
                'search_items' => __('Ferienworkshoptermin suchen', 'atelier'),
                'not_found' => __('Keine Ferienworkshoptermine gefunden', 'atelier'),
                'not_found_in_trash' => __('Keine Ferienworkshoptermine im Papierkorb gefunden', 'atelier')
            ),
            // Allows export in Tools > Export
            'can_export' => true,
            "public" => true,

            // disable archive and seo indexing
            "has_archive" => false,
            "publicly_queryable" => false,
        )
    );
}



add_action(
    'admin_head-edit.php',
    'wpse152971_edit_post_change_title_in_list'
);
function wpse152971_edit_post_change_title_in_list() {
    add_filter(
        'the_title',
        'wpse152971_construct_new_title',
        100,
        2
    );
}

function wpse152971_construct_new_title($title, $postId) {
    $postType = get_post_type($postId);
    $date_format = 'j. F Y';

    if ($postType === 'course_time') {
        $date = get_field('date', $postId);
        return date_i18n($date_format, strtotime($date));
    }

    if ($postType === 'course_date') {
        $date = get_field('date', $postId);
        return date_i18n($date_format, strtotime($date));
    }

    if ($postType === 'workshop_date') {
        $date_1 = get_field('date_1', $postId);
        $date_2 = get_field('date_2', $postId);

        $dateString = '';
        if (!empty($date_1['date'])) {
            $dateString .=  date_i18n($date_format, strtotime($date_1['date']));
        }
        if (!empty($date_2['date'])) {
            $dateString .= ' & ' .  date_i18n($date_format, strtotime($date_2['date']));
        }
        return $dateString;
    }

    return $title;
}

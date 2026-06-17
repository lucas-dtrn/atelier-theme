<?php
/*------------------------------------*/
/* Woocoommerce global */
/*------------------------------------*/

// Add product category to loop item
function woocommerce_atelier_loop_category() {
    global $post;

    $terms = get_the_terms($post->ID, 'product_cat');
    if (!$terms || is_wp_error($terms)) return; // Return if no terms

    $primary_cat_id = get_post_meta($post->ID, '_yoast_wpseo_primary_product_cat', true);

    if ($primary_cat_id) {
        // NOTE: Display primary category if set
        $primary_cat = get_term($primary_cat_id, 'product_cat');
        $cat_string = get_field('singular_name', $primary_cat->taxonomy . '_' . $primary_cat->term_id);
        if (empty($cat_string)) $cat_string = $primary_cat->name;
    } else {
        // NOTE: Display all categories if no primary category set
        $cat_links = array();
        foreach ($terms as $category) {
            $category_name = get_field('singular_name', $category->taxonomy . '_' . $category->term_id) ?? $category->name;
            if (empty($category_name)) $category_name = $category->name;
            $cat_links[] = $category_name;
        }
        $cat_string = join(" ", $cat_links);
    }

    echo '<span class="product__category">' . $cat_string . '</span>';
}

// Add short description to loop item
function woocommerce_atelier_loop_short_description() {
    global $post;
    $short_description = get_field("short_description", $post->ID);

    if (!$short_description) return; // Return if no short description

    echo '<p class="product__description">' . $short_description . '</p>';
}

// insert custom html on product archive page
function woocommerce_atelier_products_filter() {
    echo '<button class="button --color-main filters-slideover__button">' . __('Produkte filtern', 'atelier') . '</button>';
    echo '<div class="filters-slideover">';
    echo '<div class="filters-slideover__header"><h3>Filtern und Sortieren</h3><a class="filters-slideover__close"></a></div>';

    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('product-filters'));

    echo '<div class="filters-slideover__confirm">
        <a class="button --color-main">Anwenden</a>
    </div>';

    echo '</div>';
    echo '<div class="filters-slideover__backdrop"></div>';
}

/*------------------------------------*/
/* Hooks */
/*------------------------------------*/
add_action('woocommerce_before_shop_loop', 'woocommerce_atelier_products_filter', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_atelier_loop_category', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_atelier_loop_short_description', 15);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_atelier_product_badge', 20);

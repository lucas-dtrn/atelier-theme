<?php
/*------------------------------------*/
/* Woocoommerce checkout */
/*------------------------------------*/

// Function to add the product to the cart and redirect to checkout
function direct_checkout_from_url() {
    if (isset($_GET['product_id'])) {
        // remove gla_ prefix
        $product_id = str_replace('gla_', '', $_GET['product_id']);

        // check if product_id is numeric
        if (!is_numeric($product_id)) return;

        // convert to int
        $product_id = intval($product_id);

        // Check if the product exists
        if (wc_get_product($product_id)) {
            // Add the product to the cart
            WC()->cart->add_to_cart($product_id);

            // // Redirect to checkout
            // wp_safe_redirect(wc_get_checkout_url());
            // exit();
        }
    }
}

/*------------------------------------*/
/* Hooks */
/*------------------------------------*/
add_action('template_redirect', 'direct_checkout_from_url');

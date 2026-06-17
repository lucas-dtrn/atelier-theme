<?php
/*------------------------------------*/
/* Woocoommerce cart */
/*------------------------------------*/

// Add shipping notice to cart
function woocommerce_atelier_display_shipping_in_checkout_notice() {
?>
    <tr class="order-total-shipping-in-checkout-notice">
        <td colspan="2"><?php _e('Die Versandmethode kann im nächsten Schritt angepasst werden.', 'atelier'); ?></td>
    </tr>
    <script>
        jQuery(document).ready(function($) {
            // Move the new element to the correct location (sibling of .shipping__total)
            $('.order-total-shipping-in-checkout-notice').insertAfter('.shipping__total');
        });
    </script>
<?php
}

function show_coupon_item_subtotal_discount($subtotal, $cart_item, $cart_item_key) {
    //Check if sale price is not empty

    //Get product object
    $_product = $cart_item['data'];
    $line_subtotal_tax  = $cart_item['line_subtotal_tax'];

    if ($cart_item['line_subtotal'] !== $cart_item['line_total']) {

        $line_tax = $cart_item['line_tax'];
        $regular_price = $_product->get_regular_price() * $cart_item['quantity'];
        $discountAmt = wc_price(($regular_price - $cart_item['line_subtotal'] - $line_tax) + ($cart_item['line_subtotal'] - $cart_item['line_total']));

        if (!empty($_product->get_sale_price())) {

            $subtotal = sprintf(
                '
                 <del aria-hidden="true">
                     %s
                 </del>
                 <ins>
                     <span class="woocommerce-Price-amount amount">
                         <bdi>
                             %s
                         </bdi>
                     </span>
                 </ins>
                 <p>
                     Ersparnis
                     <span class="woocommerce-Price-amount amount">
                         <bdi>
                             %s
                         </bdi>
                     </span>
                 </p>',
                wc_price($regular_price),
                wc_price($cart_item['line_total'] + $line_tax),
                $discountAmt
            );
        } else {

            $subtotal = sprintf(
                '
                 <del>%s</del>
                 <ins>%s</ins>
                 <p>
                     <span>Ersparnis</span>
                     %s
                 </p>',
                wc_price($regular_price),
                wc_price($cart_item['line_total'] + $line_tax),
                $discountAmt
            );
        }
    } else if ('' !== $_product->get_sale_price()) {

        $regular_price = $_product->get_regular_price() * $cart_item['quantity'];
        $sale_price = $_product->get_sale_price() * $cart_item['quantity'];
        $discountAmt = wc_price($regular_price - $sale_price);

        $subtotal = sprintf(
            '
             <del>%s</del>
             <ins>%s</ins>
             <p>
                 <span>Ersparnis</span>
                 %s
             </p>',
            wc_price($regular_price),
            wc_price($_product->get_sale_price() * $cart_item['quantity']),
            $discountAmt
        );
    }

    return $subtotal;
}


/*------------------------------------*/
/* Hooks */
/*------------------------------------*/
add_action('woocommerce_cart_totals_after_order_total', 'woocommerce_atelier_display_shipping_in_checkout_notice');
add_filter('woocommerce_cart_item_subtotal', 'show_coupon_item_subtotal_discount', 100, 3);

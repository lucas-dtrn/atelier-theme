<?php
// TODO: Fix this
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
    return;
}
?>

<div class="cart__item <?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">

    <div class="product__image">
        <?php
        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image(), $item, $item_key);
        if (!$product_permalink) :
            echo $thumbnail; // PHPCS: XSS ok.
        else :
            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
        endif;
        ?>
    </div>

    <div class="product__infos">

        <span class="product__category"><?php echo wc_get_product_category_list($item['product_id']); ?></span>

        <div class="product__name__price">
            <span class="product__name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                <?php
                $is_visible        = $product && $product->is_visible();
                $product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);

                echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<a href="%s">%s</a>', $product_permalink, $item->get_name()) : $item->get_name(), $item, $is_visible));

                $qty          = $item->get_quantity();
                $refunded_qty = $order->get_qty_refunded_for_item($item_id);

                if ($refunded_qty) {
                    $qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
                } else {
                    $qty_display = esc_html($qty);
                }

                echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $qty_display) . '</strong>', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

                wc_display_item_meta($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
                ?>
            </span>

            <span class="product__price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                <?php echo $order->get_formatted_line_subtotal($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
            </span>
        </div>

        <?php if ($product->is_type('variation')) :
            // Get the variation attributes
            $variation_attributes = $product->get_variation_attributes();
            // Loop through each selected attributes
            foreach ($variation_attributes as $attribute_taxonomy => $term_slug) :
                // Get product attribute name or taxonomy
                $taxonomy = str_replace('attribute_', '', $attribute_taxonomy);
                // The label name from the product attribute
                $attribute_name = wc_attribute_label($taxonomy, $product);
                // The term name (or value) from this attribute
                if (taxonomy_exists($taxonomy)) :
                    $attribute_value = get_term_by('slug', $term_slug, $taxonomy)->name;
                else :
                    $attribute_value = $term_slug; // For custom product attributes
                endif;
            endforeach; ?>
            <span class="product__variation"><?php echo $attribute_name; ?>:&nbsp;<span><?php echo $attribute_value; ?></span></span>
        <?php endif; ?>

        <span class="product__quantity">Menge:&nbsp;<span><?php echo $quantity; ?></span></span>

        <?php if ($show_purchase_note && $purchase_note) : ?>
            <span class="product-purchase-note">
                <?php echo wpautop(do_shortcode(wp_kses_post($purchase_note))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  
                ?>
            </span>
        <?php endif; ?>
    </div>
</div>
<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wrapper checkout">
	<?php

	do_action('woocommerce_before_checkout_form', $checkout);

	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
		echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
		return;
	}

	?>

	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">




		<div class="cart__header step--two">
			<div class="header__left">
				<span>
					<h6><a href="https://atelier-delatron.shop/warenkorb">Warenkorb</a></h6><img src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/arrow_right_green.svg">
					<h6>Zahlung</h6><img src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/arrow_right_inputgray.svg">
					<h6>Lieferung</h6>
				</span>
				<h2>Zahlungsdetails</h2>
			</div>
			<a href="#preisubersicht" class="header__right">
				<h6>Gesamtsumme</h6>
				<!-- <h3><?php echo wc_price(WC()->cart->subtotal); ?></h3> -->
				<h3><?php echo wc_price(WC()->cart->total); ?></h3>
			</a>
		</div>






		<div class="accordeon accordeon--closed">
			<div class="accordeon__item cart__items split__right__block">
				<div class="accordeon__header">
					<h5>Warenkorb</h5>
					<div class="button__plusminus"></div>
				</div>
				<div class="accordeon__content">

					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					?>


							<div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart__item', $cart_item, $cart_item_key)); ?>">

								<div class="product__image">
									<?php
									$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

									if (!$product_permalink) {
										echo $thumbnail; // PHPCS: XSS ok.
									} else {
										printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
									}
									?>
								</div>

								<div class="product__infos">


									<div class="product__name__price">

										<span class="product__name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
											<?php
											if (!$product_permalink) {
												echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
											} else {
												echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
											}

											do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

											// Meta data.
											echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

											// Backorder notification.
											if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
												echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
											}
											?>
										</span>

										<span class="product__subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
											<?php
											echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
											?>
										</span>

									</div>



									<span class="product__quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
										Menge: <span><?php echo $cart_item['quantity']; ?></span>
									</span>


								</div>
							</div>


					<?php
						}
					}
					?>
				</div>
			</div>
		</div>







		<?php if ($checkout->get_checkout_fields()) : ?>

			<?php do_action('woocommerce_checkout_before_customer_details'); ?>

			<div class="col2-set checkout__inputs" id="customer_details">
				<div class="col-1">
					<?php do_action('woocommerce_checkout_billing'); ?>
				</div>

				<div class="col-2">
					<?php do_action('woocommerce_checkout_shipping'); ?>
				</div>
			</div>

			<?php do_action('woocommerce_checkout_after_customer_details'); ?>

		<?php endif; ?>


		<?php do_action('woocommerce_checkout_before_order_review'); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action('woocommerce_checkout_order_review'); ?>
		</div>

		<?php do_action('woocommerce_checkout_after_order_review'); ?>








	</form>

	<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

</div>
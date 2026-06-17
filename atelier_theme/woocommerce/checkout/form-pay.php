<?php

/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.2.0
 */

defined('ABSPATH') || exit;

$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>

<?php get_template_part('components/shop/payment-hero-banner', NULL, array('step' => 'payment')); ?>

<div class="left">
	<div class="cart__items cart__list">

		<?php
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

			$category_ids =  wc_get_product($cart_item['product_id'])->get_category_ids();

			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

				if (false) :
					// if( in_array(121, $category_ids) ) : 
		?>

					<div class="cart_item kunstangebot">
						Kunstangebot
					</div>

				<?php else : ?>

					<div class="cart__item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

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



							<span class="product__category"><?php echo wc_get_product_category_list($cart_item['product_id']); ?></span>


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



								<?php if (!empty($_product->get_sale_price())) : ?>

									<p class="price product__subtotal">
										<del aria-hidden="true">
											<span class="woocommerce-Price-amount amount">
												<bdi>
													<?php echo number_format(($_product->get_regular_price() * $cart_item['quantity']), 2); ?>
													<span class="woocommerce-Price-currencySymbol">€</span>
												</bdi>
											</span>
										</del>
										<ins>
											<span class="woocommerce-Price-amount amount">
												<bdi>
													<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
												</bdi>
											</span>
										</ins>
									</p>

								<?php else : ?>

									<span class="product__subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
										<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
									</span>

								<?php endif; ?>



								<!-- <?php if ($cart_item['quantity'] != 1) : ?>
											<span class="product__price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
												<span><?php echo $cart_item['quantity'] . "x "; ?></span>
												<?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok. 
												?>
											</span>
										<?php endif; ?> -->



							</div>





						</div>
					</div>

				<?php endif; ?>



		<?php
			}
		}
		?>

	</div>
</div>

<div class="right">
	<form id="order_review" method="post">

		<div class="cart__calculation">
			<h4>Bestellübersicht</h4>

			<table class="shop_table">
				<tfoot>
					<?php if ($totals) : ?>
						<?php foreach ($totals as $total) : ?>
							<tr class="tr--bold tr--border-top">
								<th scope="row" colspan="2"><?php echo $total['label']; ?></th><?php // @codingStandardsIgnoreLine 
																								?>
								<td class="product-total"><?php echo $total['value']; ?></td><?php // @codingStandardsIgnoreLine 
																								?>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tfoot>
			</table>
		</div>

		<?php
		/**
		 * Triggered from within the checkout/form-pay.php template, immediately before the payment section.
		 *
		 * @since 8.2.0
		 */
		do_action('woocommerce_pay_order_before_payment');
		?>

		<div id="payment" class="woocommerce-checkout-payment">

			<div class="payment__methods">
				<h4>Zahlungsmethoden</h4>

				<?php if ($order->needs_payment()) : ?>
					<ul class="wc_payment_methods payment_methods methods">
						<?php
						if (!empty($available_gateways)) {
							foreach ($available_gateways as $gateway) {
								wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
							}
						} else {
							echo '<li>';
							wc_print_notice(apply_filters('woocommerce_no_available_payment_methods_message', esc_html__('Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce')), 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
							echo '</li>';
						}
						?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="form-row">
				<input type="hidden" name="woocommerce_pay" value="1" />

				<?php wc_get_template('checkout/terms.php'); ?>

				<?php do_action('woocommerce_pay_order_before_submit'); ?>

				<?php echo apply_filters('woocommerce_pay_order_button_html', '<button type="submit" class="button alt" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine 
				?>

				<?php do_action('woocommerce_pay_order_after_submit'); ?>

				<?php wp_nonce_field('woocommerce-pay', 'woocommerce-pay-nonce'); ?>
			</div>

		</div>

	</form>
</div>
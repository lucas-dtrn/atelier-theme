<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;
?>

<header class="shop-hero-banner shop-hero-banner--small show-header-on-offset">

	<?php get_template_part('template-parts/paper'); ?>
	<div class="decoration">
		<div class="wrapper">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_small.svg" alt="">
		</div>
	</div>

	<?php get_template_part('template-parts/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

	<div class="shop-hero-banner__content wrapper">
		<div class="shop-hero-banner--header">

			<div class="checkout-header">
				<h1>Warenkorb</h1>
				<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">
					<span class="item --current">Warenkorb</span>
					<span class="divider">/</span>
					<span class="item" href="">Kasse</span>
					<span class="divider">/</span>
					<span class="item" href="">Bestätigung</span>
					<span class="divider">/</span>
				</nav>
			</div>

		</div>
	</div>

</header>




<!-- <div class="cart__flex"> -->
<form class="cart woocommerce-cart-form checkout-split" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

	<?php do_action('woocommerce_before_cart'); ?>

	<div class="left">
		<div class="container">


			<?php do_action('woocommerce_before_cart_table'); ?>


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

											<div class="product__subtotal--double-discount">
												<p class="price product__subtotal">
													<?php
													echo apply_filters(
														'woocommerce_cart_item_subtotal',
														WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
														$cart_item,
														$cart_item_key
													);
													?>
												</p>
											</div>

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



									<!-- <span class="product__color">Farbe/Ausführung</span> -->


									<div class="product__total__quantity__container">
										<div class="product__total__quantity">

											<!-- Mobile Elements-->

											<span class="product__total" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
												<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
											</span>

											<span class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
												<?php
												if ($_product->is_sold_individually()) {
													$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
												} else {
													$product_quantity = woocommerce_quantity_input(
														array(
															'input_name'   => "cart[{$cart_item_key}][qty]",
															'input_value'  => $cart_item['quantity'],
															'max_value'    => $_product->get_max_purchase_quantity(),
															'min_value'    => '0',
															'product_name' => $_product->get_name(),
														),
														$_product,
														false
													);
												}

												echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
												?>
											</span>

										</div>
									</div>


									<div class="product-remove">
										<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
												esc_url(wc_get_cart_remove_url($cart_item_key)),
												esc_html__('Remove this item', 'woocommerce'),
												esc_attr($product_id),
												esc_attr($_product->get_sku())
											),
											$cart_item_key
										);
										?>
									</div>


								</div>
							</div>

						<?php endif; ?>



				<?php
					}
				}
				?>

			</div>

			<button type="submit" class="button --color-main button--mini button--update-cart" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

			<?php do_action('woocommerce_after_cart_table'); ?>

		</div>
	</div>

	<div class="right">
		<div class="container">

			<?php do_action('woocommerce_cart_contents'); ?>
			<?php if (wc_coupons_enabled()) { ?>
				<div class="coupon">
					<h4>Gutscheincode eingeben</h4>

					<div class="form--one__line">
						<p id="full_name" class="form-row">
							<label class="label-name" for="coupon_code">Gutscheincode</label>
							<span>
								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php //esc_attr_e( 'Coupon code', 'woocommerce' ); 
																																?>" />
							</span>
						</p>
						<button type="submit" class="button --color-accent" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">GO<?php /* esc_attr_e( 'Apply coupon', 'woocommerce' ); */ ?></button>
					</div>
					<?php do_action('woocommerce_cart_coupon'); ?>

				</div>
			<?php } ?>

			<!-- <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button> -->
			<?php do_action('woocommerce_cart_actions'); ?>
			<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

			<?php do_action('woocommerce_after_cart_contents'); ?>


			<?php do_action('woocommerce_before_cart_collaterals'); ?>

			<div class="cart-collaterals">
				<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action('woocommerce_cart_collaterals');
				?>
			</div>

			<?php do_action('woocommerce_after_cart'); ?>
		</div>
	</div>
	<!-- </div> -->
</form>
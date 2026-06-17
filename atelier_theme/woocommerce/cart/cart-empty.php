<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

get_template_part('components/shop/payment-hero-banner', NULL, array('step' => 'cart'));

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action('woocommerce_cart_is_empty');

if (wc_get_page_id('shop') > 0) : ?>


	<?php
	/**
	 * Filter "Return To Shop" text.
	 *
	 * @since 4.6.0
	 * @param string $default_text Default text.
	 */
	$button = array(
		'title' => esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce'))),
		'url' => apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')),
	);
	?>

	<div class="left">
		<h4>Dein Warenkorb ist noch leer.</h4>
		<a class="button --color-accent" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
			<span>Produkte entdecken</span>
		</a>
		<?php get_template_part('components/button', 'main', array('button' => $button)); ?>
	</div>

	<div class="right">
		<div class="placeholder placeholder--large"></div>
	</div>

<?php endif; ?>
<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>



<header class="shop-hero-banner shop-hero-banner--small show-header-on-offset">

	<?php get_template_part('template-parts/paper'); ?>
	<div class="shop-hero-banner__decoration">
		<div class="wrapper">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
			<img src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_small.svg" alt="">
		</div>
	</div>

	<div class="shop-hero-banner__background-image">
		<?php if ($image) : ?>
			<img src="<?php echo $image; ?>" alt="">
		<?php endif; ?>
	</div>

	<?php get_template_part('template-parts/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

	<div class="shop-hero-banner__content wrapper">
		<div class="shop-hero-banner--account__header">

			<div class="checkout-header">
				<h1>Deine Bestellung</h1>
			</div>

		</div>
	</div>

</header>



<div class="woocommerce-order">
	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>

		<?php if ($order->has_status('failed')) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<!-- <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																												?></p> -->
			<h3 class="woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); ?></h3>

			<!-- <div class="order__header">
				<ul class="order__overview">
					<li>Bestelldatum<strong><strong class="order-date"><?php echo wc_format_datetime($order->get_date_created()); ?></strong></strong></li>
					<li>Bestellnummer<strong><strong class="order-number"><?php echo $order->get_order_number(); ?></strong></strong></li>
					<li>Summe<strong class="order-total"><?php echo $order->get_formatted_order_total(); ?></strong></li>
					<li>Summe<strong class="order-payment-method"><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong></li>
				</ul>
				<div class="order__actions">
					<ul class="order__overview">
						<li>Status<strong class="order-status"><?php echo esc_html(wc_get_order_status_name($order->get_status())); ?></strong></li>
					</ul>
					<?php
					$actions = wc_get_account_orders_actions($order);
					if (!empty($actions)) : ?>
						<?php foreach ($actions as $key => $action) : ?>
							<a class="button button--mini woocommerce-button button <?php echo sanitize_html_class($key); ?>" href="<?php echo $action['url']; ?>">
								<span><?php echo esc_html($action['name']); ?></span>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div> -->


			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e('Order number:', 'woocommerce'); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e('Date:', 'woocommerce'); ?>
					<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e('Email:', 'woocommerce'); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e('Total:', 'woocommerce'); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if ($order->get_payment_method_title()) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e('Payment method:', 'woocommerce'); ?>
						<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																										?></p>

	<?php endif; ?>

</div>
<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<!-- TODO: Update this view -->
<div class="wrapper">

	<div class="account__intro">
		<p>
			<?php
			printf(
				/* translators: 1: user display name 2: logout url */
				wp_kses(__('Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce'), $allowed_html),
				'<strong>' . esc_html($current_user->display_name) . '</strong>',
				esc_url(wc_logout_url())
			);
			?>
		</p>

		<p>
			<?php
			/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
			$dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
			if (wc_shipping_enabled()) {
				/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
				$dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
			}
			printf(
				wp_kses($dashboard_desc, $allowed_html),
				esc_url(wc_get_endpoint_url('orders')),
				esc_url(wc_get_endpoint_url('edit-address')),
				esc_url(wc_get_endpoint_url('edit-account'))
			);
			?>
		</p>
	</div>

	<div class="account__content account__content--dashboard">
		<div class="dashboard__links">
			<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
				<a class="dashboard__item --size-big <?php echo wc_get_account_menu_item_classes($endpoint); ?>" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
					<h3><?php echo esc_html($label); ?></h3>
				</a>
			<?php endforeach; ?>
			<a class="dashboard__item --size-small --contact" href="<?= get_permalink(get_page_by_path('kontakt-shop')); ?>">
				<h3>Kontakt</h3>
			</a>
			<a class="dashboard__item --size-small --logout" href="<?= esc_url(wc_logout_url()) ?>">
				<h3>Abmelden</h3>
			</a>
		</div>
	</div>

	<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action('woocommerce_account_dashboard');

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action('woocommerce_before_my_account');

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action('woocommerce_after_my_account');

	/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */

	?>
</div>
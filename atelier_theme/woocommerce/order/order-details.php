<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
	return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}

$payment_method = $order->get_payment_method();
$payment_method_names = array(
	'ppcp-gateway' => 'Paypal',
);
$payment_method_title = $order->get_payment_method_title();
$payment_date = $order->get_date_paid();
$notes = $order->get_customer_order_notes();
$actions = wc_get_account_orders_actions($order);

$status = $order->get_status();
$status_title = esc_html(wc_get_order_status_name($status));
if ($status === 'pending') {
	$status_description = 'Deine Bestellung ist noch nicht bezahlt. Bitte bezahle, damit wir die Bestellung weiter bearbeiten können.';
} else if ($status === 'processing') {
	$status_description = 'Deine Bestellung wurde bezahlt und kann jetzt bearbeitet werden.';
} else if ($status === 'completed') {
	$tracking_items = ast_get_tracking_items($order_id);
	$status_description = 'Deine Bestellung wurde versendet und ist auf dem Weg zu Dir.';
} else if ($status === 'on-hold') {
	$status_description = 'Deine Bestellung ist in Bearbeitung, wird aber noch durch andere Faktoren (z.B. Feiertage) verzögert.';
} else if ($status === 'arrival-shipment') {
	$status_title = "Einkauf vor Ort";
	$status_description = 'Diese Bestellung wurde vor Ort getätigt.';
} else if ($status === 'refunded') {
	$status_description = 'Deine Bestellung wurde storniert und das Geld wurde zurückerstattet.';
}
?>

<div class="account--order-single split-grid">
	<div class="left">
		<!-- <?php get_template_part('components/button', 'link', array('button' => array('url' => esc_url($orders_link), 'title' => __('Zurück zur "Bestellungen"', 'atelier')), 'direction' => 'left')); ?> -->

		<!-- Order Header -->
		<!-- TODO: Style order headers -->
		<div class="order__header">
			<?php if (!empty($actions)) : ?>
				<div class="order__actions">
					<?php foreach ($actions as $key => $action) : ?>
						<a class="button button--mini woocommerce-button button <?php echo sanitize_html_class($key); ?>" href="<?php echo $action['url']; ?>">
							<span><?php echo esc_html($action['name']); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<ul class="order__facts">
				<li class="order__fact">
					<h6><?php esc_html_e('Bestellnummer', 'atelier'); ?></h6>
					<p class="order-number"><?= $order->get_order_number(); ?></p>
				</li>

				<li class="order__fact">
					<h6><?php esc_html_e('Bestellung vom', 'atelier'); ?></h6>
					<p class="order-date"><?= wc_format_datetime($order->get_date_created()); ?></p>
				</li>

				<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
					<li class="order__fact">
						<h6><?php esc_html_e('E-Mail-Adresse', 'atelier'); ?></h6>
						<p class="order-date"><?= $order->get_billing_email(); ?></p>
					</li>
				<?php endif; ?>

				<li class="order__fact">
					<h6><?php esc_html_e('Summe', 'atelier'); ?></h6>
					<p class="order-total"><?= $order->get_formatted_order_total(); ?></p>
				</li>

				<?php if ($order->get_payment_method_title()) : ?>
					<li class="order__fact">
						<h6><?php esc_html_e('Zahlungsmethode', 'atelier'); ?></h6>
						<p class="order-total"><?= wp_kses_post($order->get_payment_method_title()); ?></p>
					</li>

				<?php endif; ?>
			</ul>
		</div>

		<!-- Order Status -->
		<div class="order__status --status-<?= $status ?>">
			<ul class="order__facts">
				<li class="order__fact">
					<h6>Status</h6>
					<p class="order-status"><?= $status_title ?></p>
				</li>
				<?php if ($shipping_date) : ?>
					<li class="order__fact">
						<h6>Versanddatum</h6>
						<p class="order-number"><?= $shipping_date ?></p>
					</li>
				<?php endif; ?>
			</ul>

			<div class="order__status__timeline">
				<div class="labels">
					<span>Bestellung</span>
					<span>Bezahlung</span>
					<span>Lieferung</span>
				</div>
				<div class="timeline">
					<div class="timeline-process"></div>
				</div>
			</div>

			<p class="order__status__description"><?= $status_description ?></p>
		</div>

		<!-- Shipping Infos -->
		<?php if (true || !empty($tracking_items)) : ?>
			<div class="shipping__status">
				<h4>Sendungen</h4>
			</div>
		<?php endif; ?>


		<!-- Order Cart -->
		<?php do_action('woocommerce_order_details_before_order_table', $order); ?>
		<div>
			<h4><?php esc_html_e('Order details', 'woocommerce'); ?></h4>
			<h6 class="cart__productcount"><?php echo $order->get_item_count(); ?> Artikel</h6>

			<div class="order__cart">
				<?php $order = wc_get_order($order_id); ?>
				<div class="cart__items">

					<?php
					do_action('woocommerce_order_details_before_order_table_items', $order);

					foreach ($order_items as $item_id => $item) {
						$product = $item->get_product();

						wc_get_template(
							'order/order-details-item.php',
							array(
								'order'              => $order,
								'item_id'            => $item_id,
								'item'               => $item,
								'show_purchase_note' => $show_purchase_note,
								'purchase_note'      => $product ? $product->get_purchase_note() : '',
								'product'            => $product,
							)
						);
					}

					do_action('woocommerce_order_details_after_order_table_items', $order);
					?>
				</div>
			</div>
		</div>

		<!-- Customer details -->
		<?php if ($show_customer_details) : ?>
			<div>
				<h4>Weitere Informationen</h4>
				<ul class="order__addresses">
					<li>
						<h6>Lieferadresse</h6>
						<p><?= $order->get_formatted_shipping_address(); ?></p>
					</li>
					<li>
						<h6>Rechnungsadresse</h6>
						<p><?= $order->get_formatted_billing_address(); ?></p>
					</li>
				</ul>
				<?php // wc_get_template('order/order-details-customer.php', array('order' => $order)); 
				?>
			</div>
		<?php endif; ?>

		<!-- Notes -->
		<?php if ($notes) : ?>
			<div>
				<h4><?php esc_html_e('Order updates', 'woocommerce'); ?></h4>
				<ol class="woocommerce-OrderUpdates commentlist notes">
					<?php foreach ($notes as $note) : ?>
						<li class="woocommerce-OrderUpdate comment note">
							<div class="woocommerce-OrderUpdate-inner comment_container">
								<div class="woocommerce-OrderUpdate-text comment-text">
									<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																					?></p>
									<div class="woocommerce-OrderUpdate-description description">
										<?php echo wpautop(wptexturize($note->comment_content)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		<?php endif; ?>
	</div>

	<div class="right">
		<div>
			<h4>Bestellübersicht</h4>
			<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
				<tfoot>
					<?php foreach ($order->get_order_item_totals() as $key => $total) : ?>
						<?php if ($key === 'discount') : ?>
							<tr data-row="<?= $key ?>">
								<th scope="row">
									<div class="shop_table__icon shop_table__icon--discount"></div>
									<?php echo esc_html(rtrim($total['label'], ':')); ?>
								</th>
								<td><?= wc_price($order->get_discount_total()) ?></td>
							</tr>
							<tr data-row="<?= $key ?>_subtotal">
								<th scope="row">Zwischensumme</th>
								<td><?= wc_price($order->get_subtotal() - $order->get_discount_total()) ?></td>
							</tr>
						<?php else : ?>
							<tr data-row="<?= $key ?>">
								<th scope="row">
									<?php if ($key === 'shipping') {
										echo '<div class="shop_table__icon shop_table__icon--shipping"></div>';
									} ?>
									<?php echo esc_html(rtrim($total['label'], ':')); ?>
								</th>
								<td><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?></td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>

					<?php if ($order->get_customer_note()) : ?>
						<tr>
							<th><?php esc_html_e('Note:', 'woocommerce'); ?></th>
							<td><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></td>
						</tr>
					<?php endif; ?>
				</tfoot>
			</table>
		</div>
		<?php do_action('woocommerce_order_details_after_order_table', $order); ?>

		<!-- Payment -->
		<?php if ($order->is_paid()) :
			$order_date_paid = $order->get_date_paid();
			$timestamp = $order_date_paid->getTimestamp() + (60 * 60 * 2);
			$payment_date = date('d. F o', $timestamp);
			$payment_time = date('G:i', $timestamp);
		?>
			<div>
				<h4>Zahlung</h4>
				<div class="order__payment">
					<?php if ($payment_method_title !== '') : ?>
						<img src="<?= get_template_directory_uri() ?>/assets/img/logos/logo-<?= $payment_method_title ?>.svg" alt="">
					<?php endif; ?>
					<p>Bezahlt <?php if ($payment_method_title !== '') {
									echo 'mit ';
								} ?><strong><?= $payment_method_title ?></strong> am <?= $payment_date ?> um <?= $payment_time ?> Uhr.</p>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<?php
	/**
	 * Action hook fired after the order details.
	 *
	 * @since 4.4.0
	 * @param WC_Order $order Order data.
	 */
	do_action('woocommerce_after_order_details', $order);
	?>
</div>
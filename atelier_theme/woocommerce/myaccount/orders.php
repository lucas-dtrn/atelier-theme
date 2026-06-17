<?php
// TODO: Optimise this code
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>

	<div class="wrapper account__content account__content--orders">

		<h2>Bestellungen</h2>

		<div class="account__list orders__list">
			<?php foreach ($customer_orders->orders as $customer_order) :
				$order = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$data = $order->get_data();
				$actions = wc_get_account_orders_actions($order);

				$currency = $data['currency'];
				$total = $order->get_formatted_order_total();
				$item_count = $order->get_item_count() - $order->get_item_count_refunded() - 1;
				$status = $data["status"];
				$link = $data[""];

				$items = $order->get_items();
				$product_id = array_values($items)[0]["product_id"];
				$product   = wc_get_product($product_id);
				$image_id  = $product->get_image_id();
				$image_url = wp_get_attachment_image_url($image_id, 'woocommerce_miniature');
				$product_name = $product->get_name();

				$shipping = $data['shipping'];
				$shipping_address = "";
				$shipping_address .= $shipping['first_name'] . " " . $shipping['last_name'];
				if ($shipping['address_1'] != "") {
					$shipping_address .= "<br>" . $shipping['address_1'];
				}
				if ($shipping['address_2'] != "") {
					$shipping_address .= "<br>" . $shipping['address_2'];
				}
				$shipping_address .= "<br>" . $shipping['postcode'] . " " . $shipping['city'];
			?>

				<div class="list__item order <?php echo esc_attr($order->get_status()); ?>">

					<div class="item__header">
						<ul class="order__facts">
							<li class="order__fact">
								<h6><?= __('Status', 'atelier') ?></h6>
								<p class="order-status"><?php echo esc_html(wc_get_order_status_name($order->get_status())); ?></p>
							</li>

							<li class="order__fact">
								<h6><?= __('Bestelldatum', 'atelier') ?></h6>
								<p>
									<time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>
								</p>
							</li>

							<li class="order__fact">
								<h6><?= __('Bestellnummer', 'atelier') ?></h6>
								<p class="order-number"><?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?></p>
							</li>

							<li class="order__fact">
								<h6><?= __('Summe', 'atelier') ?></h6>
								<p class="order-total"><?php echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count)); ?></p>
							</li>
						</ul>

						<?php if (!empty($actions)) : ?>
							<div class="order__actions">
								<?php foreach ($actions as $key => $action) : ?>
									<a class="button button--mini woocommerce-button button --color-main <?php echo sanitize_html_class($key); ?>" href="<?php echo $action['url']; ?>">
										<span><?php echo esc_html($action['name']); ?></span>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="item__content">
						<div class="order__first__product">
							<img src="<?php echo $image_url; ?>">
							<div>
								<h4><?php echo $product_name; ?></h4>
								<?php if ($item_count > 1) : ?>
									<span>+ <?php echo $item_count; ?> weitere Artikel</span>
								<?php endif; ?>
							</div>
						</div>
						<div class="order__content__infos">
							<ul class="order__facts --proxima">
								<?php if ($shipping_address != "<br>") : ?>
									<li class="order__fact">
										<h6>Lieferadresse</h6>
										<p class="order-date"><?php echo $shipping_address; ?></p>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>

				</div>

			<?php endforeach; ?>
		</div>

		<?php do_action('woocommerce_before_account_orders_pagination'); ?>

		<?php if (1 < $customer_orders->max_num_pages) : ?>
			<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
				<?php if (1 !== $current_page) : ?>
					<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce'); ?></a>
				<?php endif; ?>

				<?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
					<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce'); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>

<?php else : ?>

	<?php wc_print_notice(esc_html__('No order has been made yet.', 'woocommerce') . ' <a class="woocommerce-Button button' . esc_attr($wp_button_class) . '" href="' . esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) . '">' . esc_html__('Browse products', 'woocommerce') . '</a>', 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment 
	?>

<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
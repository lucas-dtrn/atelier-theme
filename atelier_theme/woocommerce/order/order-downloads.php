<?php

/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<section class="woocommerce-order-downloads">

	<?php if (isset($show_title)) : ?>
		<h2 class="woocommerce-order-downloads__title"><?php esc_html_e('Downloads', 'woocommerce'); ?></h2>
	<?php endif; ?>

	<div class="account__list">
		<?php foreach ($downloads as $download) : ?>
			<div class="list__item">

				<div class="item__header">
					<!-- <div class="download__product"> -->
					<?php
					$product_id = $download['product_id'];
					$product    = wc_get_product($product_id);
					$image_id   = $product->get_image_id();
					$image_url  = wp_get_attachment_image_url($image_id, 'woocommerce_miniature');
					?>
					<!-- <div>
							<h6>Kategorie</h6>
							<?php if ($download['product_url']) : ?>
								<a href="<?php echo esc_url($download['product_url']); ?>"><h4><?php echo esc_html($download['product_name']); ?></h4></a>
								<?php else : ?>
									<h4><?php echo esc_html($download['product_name']); ?></h4>
								<?php endif; ?>
							</div>
						</div> -->

					<ul class="order__facts">
						<img class="download__image" src="<?php echo $image_url; ?>">

						<li class="order__fact">
							<h6>Download</h6>
							<p>
								<?php echo esc_html($download['download_name']); ?>
							</p>
						</li>

						<li class="order__fact">
							<h6>Verbl. Downloads</h6>
							<p>
								<?php //echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'woocommerce' ); 
								?>
								<?php echo is_numeric($download['downloads_remaining']) ? esc_html($download['downloads_remaining']) : esc_html__('unbegrenzt'); ?>
							</p>
						</li>

						<li class="order__fact">
							<h6>Läuft ab</h6>
							<p>
								<?php if (!empty($download['access_expires'])) : ?>
									<time datetime="<?php echo esc_attr(date('Y-m-d', strtotime($download['access_expires']))); ?>" title="<?php echo esc_attr(strtotime($download['access_expires'])); ?>"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($download['access_expires']))) ?></time>
								<?php else : ?>
									<?php esc_html_e('Never', 'woocommerce'); ?>
								<?php endif; ?>
							</p>
						</li>
					</ul>

					<div class="order__actions">
						<a class="button button--mini --color-main woocommerce-button button" href="<?php echo esc_url($download['download_url']); ?>">
							<span>Herunterladen</span>
						</a>
					</div>
				</div>

			</div>

		<?php endforeach; ?>
	</div>

</section>
<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

// if (is_product_category()) {
global $wp_query;
$cat = $wp_query->get_queried_object();
$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
$image = wp_get_attachment_url($thumbnail_id);
// }
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="page--archive">

	<header class="shop-hero-banner shop-hero-banner--archive show-header-on-offset">
		<?php get_template_part('components/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>


		<div class="content">

			<?php if ($image) : ?>
				<div class="category__header__thumbnail">
					<img src="<?php echo $image; ?>" alt="" />
				</div>
			<?php endif; ?>

			<div class="category__header__content">

				<?php woocommerce_breadcrumb(); ?>

				<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action('woocommerce_archive_description');
				?>

			</div>
		</div>

		<div class="background-image">
			<?php if ($image) : ?>
				<img src="<?php echo $image; ?>" alt="">
			<?php endif; ?>
		</div>

		<?php get_template_part('components/paper'); ?>
		<?php get_template_part('components/shop/hero-banner-decoration'); ?>
	</header>

	<div class="wrapper">

		<?php
		if (woocommerce_product_loop()) {

		?>
			<div class="archive__controls">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action('woocommerce_before_shop_loop');
				?>
			</div>

			<div class="products-archive__list">
			<?php
			woocommerce_product_loop_start();

			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}

		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
			?>
			</div>

			<?php get_footer('shop'); ?>

	</div>

</div>
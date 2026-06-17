<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');
?>

<?php get_template_part('components/shop/hero-banner', NULL, array('title' => __('Mein Konto', 'atelier'))); ?>

<?php if (is_wc_endpoint_url('orders') || is_wc_endpoint_url('edit-address') || is_wc_endpoint_url('edit-account') || is_wc_endpoint_url('downloads')) : ?>
    <div class="back-to-dashboard">
        <?php get_template_part('components/button', 'link', array('button' => array('url' => get_permalink(get_page_by_path('dashboard')), 'title' => __('Zurück zur "Mein Konto"', 'atelier')), 'direction' => 'left')); ?>
    </div>
<?php endif; ?>


<?php do_action('woocommerce_after_account_navigation'); ?>
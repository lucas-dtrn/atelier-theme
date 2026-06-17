<?php
$step = $args['step'] ?? null;
$image = $args['image'] ?? null;

$steps = array(
    'shop' => array(
        'title' => 'Shop',
        'link' => esc_url(wc_get_page_permalink('shop'))
    ),
    'cart' => array(
        'title' => 'Warenkorb',
        'link' => esc_url(wc_get_cart_url())
    ),
    'checkout' => array(
        'title' => 'Kasse',
        'link' => esc_url(wc_get_checkout_url())
    ),
    'payment' => array(
        'title' => 'Zahlung',
        'link' => esc_url(wc_get_checkout_url())
    ),
    'confirmation' => array(
        'title' => 'Bestätigung',
        'link' => 'https://atelier-delatron.shop/bestellung'
    ),
);

// Remove all steps from $steps after the current step
$breadcrumbSteps =
    array_slice($steps, 0, array_search($step, array_keys($steps)) + 1);
?>

<header class="shop-hero-banner shop-hero-banner--small show-header-on-offset">

    <?php get_template_part('components/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <?php get_template_part('components/paper'); ?>
    <?php get_template_part('components/shop/hero-banner-decoration'); ?>

    <div class="content">
        <?php if (!empty($step)) : ?>
            <h1><?php echo $steps[$step]['title']; ?></h1>
        <?php endif; ?>

        <ul class="woocommerce-breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbSteps as $key => $item) : ?>
                <?php if (!$isFinished) : ?>
                    <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                        <?php if ($key !== $step) : ?>
                            <a href="<?= $item['link'] ?>"><?= $item['title'] ?></a>
                            <svg class='seperator' width='5' height='9' viewBox='0 0 5 9' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M0.970001 1.39999L3.97 4.39999L0.970001 7.39999' stroke='white' style='stroke:white;stroke-opacity:1;' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round' />
                            </svg>
                        <?php else : ?>
                            <span><?= $item['title'] ?></span>
                        <?php endif; ?>

                        <meta itemprop="position" content="<?= $i + 1 ?>">
                        <meta itemprop="name" content="<?= $item['title'] ?>">
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>

</header>
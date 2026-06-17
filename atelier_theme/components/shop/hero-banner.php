<?php
$title = $args['title'] ?? null;
$image = $args['image'] ?? null;
?>

<header class="shop-hero-banner show-header-on-offset">

    <?php get_template_part('components/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <?php get_template_part('components/paper'); ?>
    <?php get_template_part('components/shop/hero-banner-decoration'); ?>

    <div class="content">
        <?php if (!empty($title)) : ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php woocommerce_breadcrumb(); ?>
    </div>

    <div class="background-image">
        <?php if (!empty($image)) : ?>
            <img src="<?php echo $image; ?>" alt="">
        <?php endif; ?>
    </div>
</header>
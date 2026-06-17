<?php
$hero_banner_dekoration = get_field('hero_banner_dekoration', 'option');
if ($hero_banner_dekoration === 'none') return;
?>

<div class="decoration <?= $hero_banner_dekoration ?>">
    <div class="wrapper">
        <?php if ($hero_banner_dekoration === 'christmas') : ?>
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_large.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_medium.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/snowflake_small.svg" alt="">
        <?php elseif ($hero_banner_dekoration === 'easter') : ?>
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/deco-easter-1.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/deco-easter-2.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/deco-easter-3.svg" alt="">
            <img class="--ll-disabled" src="<?= get_template_directory_uri() ?>/assets/img/modules/shop-hero-banner/deco-easter-4.svg" alt="">
        <?php endif; ?>
    </div>
</div>
<?php
/*------------------------------------*/
/* Block Name: Media & Text */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$text = get_field('text');
$tag = $text['tag'];
$uberschrift_h5 = $text['uberschrift_h5'];
$uberschrift_h2 = $text['uberschrift_h2'];
$beschreibung = $text['beschreibung'];
$button = $text['button'];

$media = get_field('media');
$bild = $media['bild'];
$video = $media['video'];
$produkt_aktivieren = $media['produkt_aktivieren'];
$produkt = $media['produkt'];

if ($produkt) {
    $product_permalink = get_permalink($produkt->ID);
    $product_category =  wp_get_post_terms($produkt->ID, 'product_cat')[0]->name;;
    $product_title = get_the_title($produkt->ID);
    $product_short_description = get_field('short_description', $produkt->ID);
}
?>

<div class="media-text" id="<?= $id ?>">

    <div class="media-text__text">
        <div class="media-text__text__content">
            <?php get_template_part('components/paper'); ?>

            <?php if ($tag) : ?>
                <span class="tag --color-white"><?= $tag ?></span>
            <?php endif ?>

            <?php if ($uberschrift_h5) : ?>
                <h5><?= $uberschrift_h5 ?></h5>
            <?php endif ?>

            <?php if ($uberschrift_h2) : ?>
                <h2><?= $uberschrift_h2 ?></h2>
            <?php endif ?>

            <?php if ($beschreibung) : ?>
                <?= $beschreibung ?>
            <?php endif ?>

            <?php if ($button) : ?>
                <?php get_template_part('components/button', '', array('button' => $button, 'color' => 'accent')); ?>
            <?php endif ?>
        </div>
    </div>

    <div class="media-text__media">
        <?php if ($bild) : ?>
            <img src="<?= $bild['sizes']['large'] ?>" alt="<?= $bild['alt'] ?>">
        <?php endif ?>

        <?php if ($video) : ?>
            <video src="<?= $video['url'] ?>" autoplay muted loop></video>
        <?php endif ?>

        <?php if ($produkt_aktivieren) : ?>
            <div class="media-text__product">
                <div class="product__content">
                    <div class="product__text">
                        <a href="<?= $product_permalink ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                            <span class="product__category"><?= $product_category ?></span>
                            <h3 class="product__title"><?= $product_title ?></h3>
                            <p class="product__description"><?= $product_short_description ?></p>
                            <span class="price"><span class="woocommerce-Price-amount amount"><bdi><?= $product_price ?>&nbsp;<span class="woocommerce-Price-currencySymbol">€</span></bdi></span></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
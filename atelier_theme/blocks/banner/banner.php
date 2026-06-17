<?php
/*------------------------------------*/
/* Block name: Banner */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$produkte = get_field('produkte');
?>

<div class="shop-product-banner wrapper" id="<?php echo $id; ?>">

    <?php if ($produkte) : ?>
        <?php foreach ($produkte as $produkt) :
            $id = $produkt->ID;
            $postStatus = $produkt->post_status;

            // image
            $thumbnailId = get_term_meta($id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnailId);
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0];

            $category;
            $title = $produkt->post_title;
            $price;
            $link;
            $cartLink;
        ?>
            <?php if ($postStatus === 'publish') : ?>
                <div class="shop-product-banner__item">
                    <img class="item__image" src="<?= $image ?>" alt="">
                    <div class="item__info">
                        <div class="info__content">
                            <span class="product__category">Kategorie</span>
                            <span class="product__title"><?= $title ?></span>
                            <div class="price-button">
                                <span class="product__price">3,99€</span>
                                <a>In den Warenkorb</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

</div>
<?php
$imageIds = $args['imageIds'] ?? [];

$productImages = array_map(function ($imageId) {
    return array(
        'slider' => wp_get_attachment_image_src($imageId, 'woocommerce_single'),
        'lightbox' => wp_get_attachment_image_src($imageId, 'large'), // FULL
        'thumbnail' =>  wp_get_attachment_image_src($imageId, 'thumbnail'),
    );
}, $imageIds);
?>

<div class="product-gallery">
    <?php if (!empty($productImages)) : ?>

        <div class="swiper main-slider" id="product-gallery-slider">
            <div class="swiper-wrapper">
                <?php foreach ($productImages as $image) : ?>
                    <div class="swiper-slide">
                        <a data-pswp-src="<?php echo $image['lightbox'][0] ?>" data-pswp-width="<?php echo $image['lightbox'][1] ?>" data-pswp-height="<?php echo $image['lightbox'][2] ?>">
                            <img src="<?php echo esc_url($image['slider'][0]); ?>" alt="" />
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="slider__pagination"></div>

            <div class="slider__button --prev"></div>
            <div class="slider__button --next"></div>
        </div>

        <?php if (count($productImages) > 1) : ?>
            <div class="swiper thumbs-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($productImages as $image) : ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($image['thumbnail'][0]); ?>" alt="" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>
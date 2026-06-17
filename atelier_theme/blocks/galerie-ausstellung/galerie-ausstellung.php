<?php
/*------------------------------------*/
/* Block Name: Galerie Ausstellung */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$ausrichtung = get_field("ausrichtung");
$images = get_field('galerie');
$uberschrift_h6 = get_field("uberschrift_h6");
$uberschrift_h2 = get_field("uberschrift_h2");
?>

<div id="<?php echo $id; ?>" class="galerie__ausstellung <?= $ausrichtung ?>">

    <div class="swiper">

        <div class="wrapper galerie__texts">
            <div class="galerie__title">
                <h6><?= $uberschrift_h6 ?></h6>
                <h2><?= $uberschrift_h2 ?></h2>
                <p><span class="count"><?= count($images) ?></span><span class="text">Kunstwerke</span></p>
            </div>
            <div class="swiper__buttons">
                <div class="gallery__button button__prev swiper__prev"></div>
                <div class="gallery__button button__next swiper__next"></div>
            </div>
        </div>

        <div class="swiper-wrapper lightbox">
            <?php if ($images) : ?>
                <?php $first_slide = true; ?>
                <?php foreach ($images as $image) :
                    $title = $image["title"];
                    $caption = $image["caption"];
                    $url_lightbox = $image['sizes']['large'];
                    $url_preview = $image['sizes']['large'];
                ?>
                    <div class="swiper-slide <?php if ($first_slide === true) {
                                                    echo "swiper-slide-activekk";
                                                } ?>">
                        <img class="image__img lightbox__image swiper-lazy" src="<?php echo esc_url($url_preview); ?>" alt="" data-lightbox-src="<?php echo esc_url($url_lightbox); ?>" data-title="<?php echo esc_attr($title); ?>" data-caption="<?php echo esc_attr($caption) ?>" />
                        <div class="gallery__meta">
                            <div class="meta__text">
                                <h5><?= $title ?></h5>
                                <h6><?= $caption ?></h6>
                            </div>
                            <div class="icon__scale-up">
                                <img class="icon--main" src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_scale_up.svg" alt="">
                                <img class="icon--one" src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_scale_up_top_right.svg" alt="">
                                <img class="icon--two" src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_scale_up_bottom_left.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <?php $first_slide = false; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="wrapper galerie__pagination">
            <div class="swiper-pagination"></div>
        </div>

    </div>





    <div class="gallery__popup">
        <div class="popup__background"></div>
        <div class="popup__image">
            <img class="image__img">
            <div class="gallery__meta">
                <div class="meta__text">
                    <h5></h5>
                    <h6></h6>
                </div>
            </div>
        </div>
        <div class="gallery__buttons">
            <div class="gallery__button button__prev"></div>
            <div class="gallery__button button__next"></div>
        </div>
        <span class="gallery__indicator"></span>
    </div>




</div>
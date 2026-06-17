<?php
/*------------------------------------*/
/* ACF Block: Shop Hero Banner */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$uberschrift_h1 = get_field('uberschrift_h1');
$ankundigung = get_field('ankundigung');
$slides = get_field('slides');
$hero_banner_dekoration = get_field('hero_banner_dekoration', 'options');
?>

<div class="shop-hero-banner shop-hero-banner--large show-header-on-offset" id="<?= $id ?>">

    <?php get_template_part('components/header-bar', '', array('type' => 'shop', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <?php get_template_part('components/paper'); ?>
    <?php get_template_part('components/shop/hero-banner-decoration'); ?>

    <?php if ($uberschrift_h1) : ?>

        <div class="content">
            <h1><?= $uberschrift_h1 ?></h1>
            <?php woocommerce_breadcrumb(); ?>
        </div>

    <?php else : ?>

        <?php if (!empty($slides)) : ?>
            <div class="content-split">

                <div class="text-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">

                            <?php foreach ($slides as $slide) :
                                $text = $slide['text'];
                                $tag = $text['tag'];
                                $uberschrift_h2 = $text['uberschrift_h2'];
                                $uberschrift_h5 = $text['uberschrift_h5'];
                                $uberschrift_h1_aktivieren = $text['uberschrift_h1_aktivieren'];
                                $beschreibung = $text['beschreibung'];
                                $button = $text['button']; ?>

                                <div class="swiper-slide">
                                    <?php get_template_part('components/tag', '', array('tagname' => $tag, 'color' => 'white')); ?>
                                    <?php if ($uberschrift_h1_aktivieren) : ?>
                                        <h1><?= $uberschrift_h2 ?></h1>
                                    <?php else : ?>
                                        <h2><?= $uberschrift_h2 ?></h2>
                                    <?php endif; ?>
                                    <h5><?= $uberschrift_h5 ?></h5>
                                    <p><?= $beschreibung ?></p>
                                    <div class="button-container">
                                        <a class="button" href="<?= $button['url']; ?>"><span><?= $button['title']; ?></span></a>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="image-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">

                            <?php foreach ($slides as $slide) :
                                $bild = $slide['bild']; ?>

                                <div class="swiper-slide">
                                    <img src="<?= $bild['sizes']['medium'] ?>" width="350" height="450" alt="<?= $bild['alt'] ?>">
                                </div>

                            <?php endforeach; ?>
                        </div>

                    </div>

                    <button type="button" class="--prev" aria-label="Vorheriger Slide"></button>
                    <button type="button" class="--next" aria-label="Nächster Slide"></button>
                </div>

            </div>
        <?php endif; ?>

    <?php endif; ?>


    <?php if (have_rows('slides')) : ?>
        <div class="process-button --filled">
            <svg viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="17" stroke="#152F43" stroke-width="3" fill="none" />
                <circle class="process" cx="20" cy="20" r="17" stroke="#55d045" stroke-width="3" fill="none" transform="rotate(-90)" transform-origin="20 20" />
            </svg>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($ankundigung)) : ?>
    <div class="shop-alert">
        <div>
            <?php for ($i = 0; $i < 35; $i++) : ?>
                <span><?= $ankundigung ?></span>
                <span class="--plus">+++</span>
            <?php endfor; ?>
        </div>
    </div>
<?php else : ?>
    <!-- <div class="bottom-border"></div> -->
<?php endif; ?>
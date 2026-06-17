<?php
/*------------------------------------*/
/* Block name: Shop Hero Banner */
/*------------------------------------*/

global $websiteMode;

$id = $block['anchor'] ?? $block['id'];

// ACF fields
$uberschrift_h1 = get_field('uberschrift_h1');
$ankundigung = get_field('ankundigung');
?>

<div class="hero-banner show-header-on-offset <?= $ankundigung ? '--remove-border' : '' ?>" id="<?= $id ?>">

    <?php get_template_part('components/header-bar', '', array('type' => $websiteMode, 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <?php get_template_part('components/paper'); ?>
    <?php get_template_part('components/shop/hero-banner-decoration'); ?>

    <?php if ($uberschrift_h1) : ?>

        <div class="shop-hero-banner__content wrapper">
            <h1><?= $uberschrift_h1 ?></h1>
        </div>

    <?php else : ?>

        <div class="shop-hero-banner__image-text wrapper">
            <?php if (have_rows('slides')) : ?>
                <div class="shop-hero-banner__text">
                    <?php while (have_rows('slides')) : the_row();
                        $text = get_sub_field('text');
                        $tag = $text['tag'];
                        $uberschrift_h2 = $text['uberschrift_h2'];
                        $uberschrift_h5 = $text['uberschrift_h5'];
                        $uberschrift_h1_aktivieren = $text['uberschrift_h1_aktivieren'];
                        $beschreibung = $text['beschreibung'];
                        $button = $text['button'];
                        $bild = get_sub_field('bild');
                    ?>
                        <div class="shop-hero-banner__text__item">
                            <div>
                                <?php get_template_part('components/tag', '', array('tagname' => $tag, 'color' => 'white')); ?>
                                <?php if ($uberschrift_h1_aktivieren) : ?>
                                    <h1><?= $uberschrift_h2 ?></h1>
                                <?php else : ?>
                                    <h2><?= $uberschrift_h2 ?></h2>
                                <?php endif; ?>
                                <h5><?= $uberschrift_h5 ?></h5>
                            </div>
                            <div>
                                <p><?= $beschreibung ?></p>
                                <a class="button" href="<?= $button['url']; ?>"><span><?= $button['title']; ?></span></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <?php if (have_rows('slides')) : ?>
                <div class="shop-hero-banner__image">
                    <div class="hero__slider">
                        <?php while (have_rows('slides')) : the_row();
                            $bild = get_sub_field('bild');
                        ?>
                            <div class="hero__slider__item">
                                <img src="<?= $bild['sizes']['medium'] ?>" alt="<?= $bild['alt'] ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button type="button" class="hero__slider__button hero__slider__button--prev" aria-label="Vorheriger Slide"></button>
                    <button type="button" class="hero__slider__button hero__slider__button--next" aria-label="Nächster Slide"></button>
                </div>
            <?php endif; ?>
        </div>

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
<?php endif; ?>
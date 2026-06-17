<?php
/*------------------------------------*/
/* Block Name: Produktslider */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$uberschrift_h5 = get_field('uberschrift_h5');
$uberschrift_h2 = get_field('uberschrift_h2');
$inhalte = get_field('inhalte');
$inhal = get_field('inhal');
$button = get_field('button');
$auswahl = get_field('auswahl');
?>

<div id="<?php echo $id; ?>" class="produktslider --hide-badges">

    <?php if ($uberschrift_h5 || $uberschrift_h2 || $button) : ?>
        <div class="produktslider__header inner">
            <div>
                <?php if (!empty($uberschrift_h5)) : ?>
                    <h5><?php echo $uberschrift_h5; ?></h5>
                <?php endif; ?>
                <?php if (!empty($uberschrift_h2)) : ?>
                    <h2><?php echo $uberschrift_h2; ?></h2>
                <?php endif; ?>
            </div>
            <?php if (!empty($button)) : ?>
                <?php get_template_part('components/button', '', array('button' => $button)); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="slider__container">

        <?php if ($auswahl) : ?>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($auswahl as $product) : ?>
                        <div class="swiper-slide">
                            <?php
                            $post_object = get_post($product->ID);
                            setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                            wc_get_template_part('content', 'product');
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="slider__controls">
                    <div class="slider__buttons">
                        <div class="slider__button --prev"></div>
                        <div class="slider__button --next"></div>
                    </div>

                    <div class="slider__pagination"></div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (have_rows('kategorien')) : ?>

            <div class="swiper">
                <div class="swiper-wrapper">

                    <?php while (have_rows('kategorien')) : the_row();
                        $inhalt = get_sub_field('inhalt');
                        $term = get_term($inhalt);
                        $link = get_term_link($inhalt);
                        $name = $term->name;
                        $thumbnail_id = get_term_meta($inhalt, 'thumbnail_id', true);
                        $bild = wp_get_attachment_image_url($thumbnail_id, 'medium');
                    ?>

                        <a class="swiper-slide category-slide" href="<?php echo $link; ?>" aria-label="Alle Produkte der Kategorie '<?= $name ?>' ansehen">
                            <div class="slider__item">
                                <img class="item__background" src="<?= $bild ?>" alt="">
                                <h3 class="item__title"><?php echo $name; ?></h3>
                                <div class="item__gradient"></div>
                            </div>
                        </a>

                    <?php endwhile; ?>

                </div>

                <div class="slider__controls">
                    <div class="slider__buttons">
                        <div class="slider__button --prev"></div>
                        <div class="slider__button --next"></div>
                    </div>

                    <div class="slider__pagination"></div>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

</div>
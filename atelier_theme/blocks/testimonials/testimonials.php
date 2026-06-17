<?php
/*------------------------------------*/
/* Block name: Testimonials */
/*------------------------------------*/

// ACF Fields
$headline_h2 = get_field("headline_h2");
$button = get_field("button");
$id = $block['anchor'] ?? $block['id'];
?>

<div id="<?php echo $id; ?>" class="testimonials">

    <div class="wrapper">

        <div class="testimonials__content">
            <?php if (have_rows('testimonials')) : ?>
                <div class="quote__list">
                    <?php while (have_rows('testimonials')) : the_row();
                        $text = get_sub_field('text');
                        $author = get_sub_field('author');
                        $info = get_sub_field('info');
                    ?>
                        <div class="list__item">
                            <p><?= $text ?></p>
                            <div class="item__infos">
                                <img src="<?= get_template_directory_uri() ?>/assets/img/website/testimonial_quote_bottom.svg">
                                <div>
                                    <h5><?= $author ?></h5>
                                    <?php if (!empty($info)) : ?>
                                        <h6><?= $info ?></h6>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($button)) : ?>
                <a class="button --color-main  " href="<?= $button["url"] ?>" target="<?= $button["target"] ?>">
                    <span><?= $button["title"] ?></span>
                    <img src="<?= get_template_directory_uri() ?>/assets/img/elements/arrow_right_white.svg">
                </a>
            <?php endif; ?>
        </div>

        <div class="testimonials__sticky">
            <div>
                <h2><?= $headline_h2 ?></h2>
                <img src="<?= get_template_directory_uri() ?>/assets/img/website/testimonial_background.jpg">
            </div>
        </div>

    </div>

</div>
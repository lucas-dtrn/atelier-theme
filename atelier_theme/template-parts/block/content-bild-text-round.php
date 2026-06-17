<?php

/**
 * Block Name: Bild & Text Rund
 *
 */

// get fields
$reihenfolge = get_field("reihenfolge");
$bild = get_field("bild");
$inhalt = get_field("inhalt");

$text = $inhalt["text"];
$button = $inhalt["button"];

$id = $block["id"];
?>



<div id="<?php echo $id; ?>" class="bild__text <?php echo esc_attr($reihenfolge); ?> wrapper">

    <?php if (!empty($bild)) : ?>
        <img class="bild__text__image" src="<?php echo esc_url($bild['url']); ?>" alt="<?php echo esc_attr($bild['alt']); ?>" />
    <?php endif; ?>

    <div class="bild__text__content">

        <?php if (!empty($text)) : ?>
            <?php echo $text; ?>
        <?php endif; ?>

        <?php if (!empty($button)) : ?>
            <a class="button  --color-main  " href="<?php echo $button["url"] ?>" target="<?php echo $button["target"]; ?>">
                <span><?php echo $button["title"]; ?></span>
            </a>
        <?php endif; ?>

    </div>

</div>




<div class="list__item item--1" id="<?= $courses["anchor"] ?>">

    <div class="item__image">
        <?php if (!empty($c_image)) : ?>
            <img class="image" src="<?= $c_image["url"]; ?>" alt="<?= $c_image["alt"]; ?>">
        <?php endif; ?>
        <img class="image__mask" src="<?= get_template_directory_uri(); ?>/assets/img/website/home/mask_blue.svg" alt="">
    </div>

    <div class="item__content">
        <h2><?= $c_headline_h2 ?></h2>
        <h6><?= $c_headline_h6 ?></h6>

        <p><?= $c_text ?></p>

        <p class="two-buttons-vertical">
            <a class="button --color-blue" href="<?= $c_button_1["url"] ?>" target="">
                <span><?= $c_button_1["title"] ?></span>
            </a>
            <a class="button --color-purple" href="<?= $c_button_2["url"] ?>" target="">
                <span><?= $c_button_2["title"] ?></span>
            </a>
        </p>

        <p class="background__number">1</p>
    </div>
</div>
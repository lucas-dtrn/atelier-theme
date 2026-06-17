<?php

/**
 * Block Name: Home Banner
 *
 */

// get fields
$quote = get_field("quote");
$author = get_field("author");
$headline_h1 = get_field("headline_h1");
$headline_h6 = get_field("headline_h6");
$button_1 = get_field("button_1");
$button_2 = get_field("button_2");
$button_3 = get_field("button_3");

$id = $block["id"];
?>



<div id="<?php echo $id; ?>" class="home__banner">

    <div class="banner__content">

        <?php get_template_part('template-parts/header-bar', '', array('type' => 'atelier', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

        <div class="wrapper">
            <div class="banner__quote">
                <p><?= $quote ?></p>
                <span>– <?= $author ?></span>
            </div>

            <div class="banner__text__image">
                <div class="banner__text">
                    <h1><?= $headline_h1 ?></h1>
                    <h6><?= $headline_h6 ?></h6>
                    <!-- <p>Komm ins Atelier Kunst & Gestalten und lasse deiner Kreativität unter professioneller Anleitung freien Lauf! Egal ob Malen, Werkeln oder Basteln - Hier findest du den perfekten Raum ohne Druck und Angst.</p> -->
                    <p class="two-buttons-vertical">
                        <?php if (!empty($button_1)) : ?>
                            <a class="button --color-accent  " href="<?= $button_1["url"] ?>" target="<?= $button_1["target"]; ?>">
                                <span><?= $button_1["title"]; ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($button_2)) : ?>
                            <a class="button --color-white  " href="<?= $button_2["url"] ?>" target="<?= $button_2["target"]; ?>">
                                <span><?= $button_2["title"]; ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($button_3)) : ?>
                            <a class="button --color-white  " href="<?= $button_3["url"] ?>" target="<?= $button_3["target"]; ?>">
                                <span><?= $button_3["title"]; ?></span>
                            </a>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="banner__portrait">
                    <img class="portrait__image" src="<?= get_template_directory_uri() ?>/assets/img/website/home/banner_portrait.png">
                    <img class="portrait__white" src="<?= get_template_directory_uri() ?>/assets/img/website/home/banner_portrait_white.svg">
                    <img class="portrait__border" src="<?= get_template_directory_uri() ?>/assets/img/website/home/banner_portrait_border.svg">
                </div>
            </div>
        </div>

        <img class="banner__background" src="<?= get_template_directory_uri() ?>/assets/img/website/home/banner_background.png" alt="">

    </div>

    <div class="wrapper">
        <?php get_template_part('template-parts/button-scrolldown', '', array('href' => '#Kurse')); ?>
    </div>

</div>
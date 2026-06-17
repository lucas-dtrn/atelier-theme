<?php

/**
 * Seitenanfang
 * 
 */


$id = $block['id'];
// Load custom field values.

// Define notification message shown when editing.
$notification = 'Parallax Bild';

$hintergrund = get_field("hintergrund");

?>
<div id="<?php echo $id; ?>" class="page__start <?php if ($hintergrund) {
                                                    echo "--background-image";
                                                } ?>">

    <?php if ($is_preview) : ?>
        <span class="restricted-block-notification"><b><?php echo esc_html($notification); ?></b></span>
    <?php endif; ?>

    <?php get_template_part('template-parts/header-bar', '', array('type' => 'atelier', 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <style>
        .page__start .--wrapper-page-start {
            margin-bottom: <?= get_field("margin") ?>px;
        }

        @media only screen and (max-width: 768px) {
            .page__start .--wrapper-page-start {
                margin-bottom: <?= get_field("margin_mobil") ?>px;
            }
        }
    </style>

    <div class="wrapper --wrapper-page-start">
        <InnerBlocks />
    </div>

    <?php if (!empty($hintergrund)) : ?>
        <img class="background__image" src="<?= $hintergrund["url"] ?>" alt="<?= $hintergrund["alt"] ?>">
    <?php endif; ?>

    <?php get_template_part('template-parts/paper'); ?>

    <img class="background__circle" src="<?= get_template_directory_uri() ?>/assets/img/website/kontakt/kontakt_background_circle.svg" alt="">
</div>
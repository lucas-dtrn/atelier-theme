<?php
/*------------------------------------*/
/* Block Nanme: Newsletter */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF fields
$uberschrift_h5 = get_field('uberschrift_h5');
$uberschrift_h2 = get_field('uberschrift_h2');
$text = get_field('text');
$bild = get_field('bild');
?>

<div class="newsletter" id="<?php echo $id; ?>">
    <div class="content">

        <img class="decoration" src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/icon_newsletter_send.svg" alt="">

        <h6><?php echo $uberschrift_h5; ?></h6>
        <h2><?php echo $uberschrift_h2; ?></h2>
        <p><?php echo $text; ?></p>

        <div class="form--newsletter">
            <?= do_shortcode('[sibwp_form id=2]'); ?>
        </div>

    </div>

    <div class="image">
        <?php if (!empty($bild)) : ?>
            <img src="<?php echo esc_url($bild['url']); ?>" alt="<?php echo esc_attr($bild['alt']); ?>" />
        <?php endif; ?>
    </div>
</div>
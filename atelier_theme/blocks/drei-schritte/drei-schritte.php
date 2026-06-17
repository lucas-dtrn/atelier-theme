<?php
/*------------------------------------*/
/* Block Name: 3 Schritte */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];
?>

<div id="<?php echo $id; ?>" class="drei-schritte wrapper">

    <?php if (have_rows('schritte')) : ?>
        <?php while (have_rows('schritte')) : the_row(); ?>
            <?php
            $icon = get_sub_field('icon');
            $uberschrift = get_sub_field('uberschrift');
            $text = get_sub_field('text');
            $hintergrund = get_sub_field('hintergrund');
            ?>
            <div class="schritte__item">
                <?php if (!empty($icon)) : ?>
                    <img class="icon" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                <?php endif; ?>
                <h3><?php echo $uberschrift; ?></h3>
                <p><?php echo $text; ?></p>
                <?php if (!empty($hintergrund)) : ?>
                    <img class="number" src="<?php echo esc_url($hintergrund['url']); ?>" alt="<?php echo esc_attr($hintergrund['alt']); ?>" />
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
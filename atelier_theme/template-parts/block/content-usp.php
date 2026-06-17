<?php

/**
 * Block Name: USP
 *
 */


// get fields
$id = $block['id'];
?>

<div class="usp inner" id="<?= $id ?>">
    <?php if (have_rows('usp')) : ?>
        <?php while (have_rows('usp')) : the_row();
            $icon = get_sub_field('icon');
            $uberschrift_h3 = get_sub_field('uberschrift_h3');
            $beschreibung = get_sub_field('beschreibung');
        ?>
            <div class="usp__item">
                <?php if ($icon) : ?>
                    <img class="icon" src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>">
                <?php endif; ?>

                <?php if ($uberschrift_h3) : ?>
                    <h3><?= $uberschrift_h3; ?></h3>
                <?php endif; ?>

                <?php if ($beschreibung) : ?>
                    <p><?= $beschreibung; ?></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
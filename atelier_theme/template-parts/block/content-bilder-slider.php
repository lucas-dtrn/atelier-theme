<?php
/**
 * Block Name: Bilder Slider
 *
 */

// get fields
$images = get_field('galerie');

$id = $block["id"];
?>

<div id="<?php echo $id; ?>" class="bilder__slider">

    <div class="continuous">
    <!-- <div class="swiper"> -->

        <!-- <div class="swiper-wrapper"> -->
            <?php if( $images ): ?>
                <?php foreach( $images as $image ): ?>
                    <!-- <div class="swiper-slide"> -->
                        <img src="<?= $image["url"]; ?>" alt="<?= $image['alt'] ?>">
                    <!-- </div> -->
                <?php endforeach; ?>
            <?php endif; ?>
        <!-- </div> -->

    </div>

</div>
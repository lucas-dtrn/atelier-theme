<?php
/*------------------------------------*/
/* Block Name: Bilder Slider */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$images = get_field('galerie');
?>

<div id="<?php echo $id; ?>" class="bilder__slider">

    <div class="continuous">
        <?php if ($images) : ?>
            <?php foreach ($images as $image) : ?>

                <img src="<?= $image["url"]; ?>" alt="<?= $image['alt'] ?>">
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
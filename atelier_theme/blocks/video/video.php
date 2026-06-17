<?php
/*------------------------------------*/
/* Block Name: Video */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$video = get_field("video");
?>

<div id="<?php echo $id; ?>" class="video wrapper">

    <?php if ($video) : ?>
        <video src="<?php echo $video['url']; ?>" autoplay muted loop></video>
    <?php endif; ?>

</div>
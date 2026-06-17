<?php
/**
 * Block Name: Video
 *
 */

// get fields
$video = get_field("video");

$id = $block['id'];
?>


<div id="<?php echo $id; ?>" class="video wrapper">

    <?php if( $video ): ?>
        <video src="<?php echo $video['url']; ?>" autoplay muted loop></video>
    <?php endif; ?>

</div>
<?php
/**
 * Block Name: Headline & Button
 *
 */

// get fields
$headline_h6 = get_field("headline_h6");
$headline_h2 = get_field("headline_h2");
$button = get_field("button");
?>


<div class="headline__button">
    <div>
        <h6><?= $headline_h6 ?></h6>
        <h2><?= $headline_h2 ?></h2>
    </div>
    <a class="button --color-main  " href="<?= $button["url"] ?>" target="<?= $button["target"] ?>">
        <span><?= $button["title"] ?></span>
    </a>
</div>
<?php
/*------------------------------------*/
/* Block name: Button  */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// BUGFIX: Mobile spacing not working

// get fields
$button = get_field("erster_button");
$button_link = $button['link'];
$button_farbe = $button['farbe'];

$button_2 = get_field("zweiter_button");
$button_2_link = $button_2['link'];

$id = $block['anchor'] ?? $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>

<p id="<?php echo $id; ?>" class="two-buttons <?php echo $align_class; ?>">
    <?php if (!empty($button_link)) : ?>
        <a class="button --color-<?php echo $button_farbe; ?>" href="<?php echo $button_link['url']; ?>" target="<?php echo $button_link['target']; ?>">
            <span><?php echo $button_link["title"]; ?></span>
        </a>
    <?php endif; ?>

    <?php if (!empty($button_2_link)) : ?>
        <a class="arrow__button" href="<?php echo $button_2_link['url']; ?>" target="<?php echo $button_2_link['target']; ?>">
            <span><?php echo $button_2_link["title"]; ?></span>
        </a>
    <?php endif; ?>
</p>
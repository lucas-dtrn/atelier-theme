<?php
$button = $args['button'];
$color = $args['color'] ?? 'main';
$class = $args['class'] ?? '';
$disabled = $args['disabled'] ?? false;
$size = $args['size'] ?? '';
$icon = $args['icon'] ?? false;
$iconPosition = $args['iconPosition'] ?? 'left';
if ($button) :
    $link_url = $button['url'];
    $link_title = $button['title'];
    $link_target = !empty($button['target']) ? $button['target'] : '_self';
?>
    <a class="button --color-<?php echo $color; ?> --size-<?= $size ?> <?= $class ?>" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" <?= $disabled ? 'disabled' : '' ?>>
        <?php if ($icon && $iconPosition === 'left') : ?>
            <?php get_template_part('components/icon', 'feather', array('icon' => $icon, 'color' => 'white', 'size' => 'small')) ?>
        <?php endif; ?>

        <span><?php echo $link_title; ?></span>

        <?php if ($icon && $iconPosition === 'right') : ?>
            <?php get_template_part('components/icon', 'feather', array('icon' => $icon, 'color' => 'white', 'size' => 'small')) ?>
        <?php endif; ?>
    </a>
<?php endif; ?>
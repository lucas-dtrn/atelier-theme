<?php
$button = $args['button'];
$color = $args['color'] ?? 'main';
$icon = $args['icon'] ?? false;
$class = $args['class'] ?? '';
$disabled = $args['disabled'] ?? false;
if ($button) :
    $link_url = $button['url'];
    $link_title = $button['title'];
    $link_target = !empty($button['target']) ? $button['target'] : '_self';
?>
    <a class="button --color-<?php echo $color; ?> <?= $class ?>" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" <?= $disabled ? 'disabled' : '' ?>>
        <?php if ($icon) : ?>
            <?php get_template_part('template-parts/icon', 'feather', array('icon' => $icon, 'color' => 'white', 'size' => 'small')) ?>
        <?php endif; ?>

        <span><?php echo $link_title; ?></span>
    </a>
<?php endif; ?>
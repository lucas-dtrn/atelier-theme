<?php
$url = $args['url'] ?? false;
$icon = $args['icon'] ?? false;
$color = $args['color'] ?? 'main';
$size = $args['size'] ?? 'normal';
$alt = $args['alt'] ?? $icon;
?>
<?php if ($url) : ?>
    <img class="icon --size-<?= $size ?>" alt="<?= $alt ?>" src="<?= $url ?>">
<?php else : ?>
    <?php if ($icon) : ?>
        <img class="icon --size-<?= $size ?>" alt="<?= $alt ?>" src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_<?= $icon ?>_<?= $color ?>.svg">
    <?php endif; ?>
<?php endif; ?>
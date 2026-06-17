<?php
$icon = $args['icon'] ?? false;
$size = $args['size'] ?? 'normal';
$color = $args['color'] ?? "main";
$strokeWidth = $args['strokeWidth'] ?? 3.5;
?>

<svg class="feather --size-<?= $size ?> --color-<?= $color ?>" stroke-width="<?= $strokeWidth ?>">
    <use href="<?= get_template_directory_uri() ?>/assets/feather-sprite.svg#<?= $icon ?>" />
</svg>
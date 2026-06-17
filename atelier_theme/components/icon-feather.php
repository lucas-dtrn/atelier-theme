<?php
$icon = $args['icon'] ?? false;
$size = $args['size'] ?? '';
$color = $args['color'] ?? '';
$strokeWidth = $args['strokeWidth'] ?? 3;
?>

<svg class="feather feather-icon --size-<?= $size ?> --color-<?= $color ?>" stroke-width="<?= $strokeWidth ?>">
    <use href="<?= get_template_directory_uri() ?>/assets/feather-sprite.svg#<?= $icon ?>" />
</svg>
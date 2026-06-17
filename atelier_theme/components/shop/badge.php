<?php
$label = $args['label'];

$class = $args['class'];
$icon = $args['icon'];
$tooltip = $args['tooltip'];
$color = $args['color'];
$hideOnArchive = $args['hideOnArchive'];
$size = $args['size'] ?? 'large';

// Set color style when color is given
if ($color) $colorStyle = 'color:' . $color;
?>

<?php if ($label) : ?>
    <div class="badge --size-<?= $size ?>" style="<?= $colorStyle ?>">
        <span class="badge-label">
            <?php if ($icon && is_string($icon)) : ?>
                <?php get_template_part('components/icon', 'feather', array('icon' => $icon)); ?>
            <?php endif; ?>

            <?= $label ?>
        </span>

        <?php if ($tooltip) : ?>
            <i class="badge-info-button tooltip" data-tippy-content="<?= $tooltip ?>">
                <?php get_template_part('components/icon', 'feather', array('icon' => 'info')); ?>
            </i>
        <?php endif; ?>
    </div>
<?php endif; ?>
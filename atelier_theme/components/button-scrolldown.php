<?php
$href = $args['href'] ?? "";
?>

<a class="button--scrolldown" href="<?= $href ?>">
    <div class="button--scrolldown__chevron">
        <?php get_template_part('components/icon-feather', '', array('icon' => 'chevron-down')); ?>
    </div>

    <span class="button--scrolldown__title">Mehr erfahren</span>
</a>
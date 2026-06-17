<?php
$items = $args['items'] ?? [];
?>

<?php if (!empty($items)) : ?>

    <div class="usp-tiles" id="<?php echo $id; ?>">

        <?php foreach ($items as $item) : the_row();
            $icon = $item["icon" ?? null];
            $headline_h3 = $item["headline_h3"] ?? null;
            $headline_h6 = $item["headline_h6"] ?? null;
            $text = $item["text"] ?? null; ?>

            <div class="usp__item">
                <?php if (!empty($icon)) : ?>
                    <div class="circle"><img src="<?= $icon["url"]; ?>" alt="<?= $icon["alt"]; ?>"></div>
                <?php endif; ?>
                <?php if (!empty($headline_h3)) : ?>
                    <h3 class="title"><?= $headline_h3 ?></h3>
                <?php endif; ?>
                <?php if (!empty($headline_h6)) : ?>
                    <span class="h6 subline"><?= $headline_h6 ?></span>
                <?php endif; ?>
                <?php if (!empty($text)) : ?>
                    <?= $text ?>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>
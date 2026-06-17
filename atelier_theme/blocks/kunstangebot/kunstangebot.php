<?php
/*------------------------------------*/
/* Block Name: Kunstangebot Item */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$reihenfolge = get_field("reihenfolge");

$bild = get_field("bild");
$bilddatei = $bild["bilddatei"];
$maske = $bild["maske"];
$maske_mobile = $bild["maske_mobile"];

$inhalt = get_field("inhalt");
$nummer = $inhalt["nummer"];
$anmerkung = $inhalt["anmerkung"];
$uberschrift_h6 = $inhalt["uberschrift_h6"];
$uberschrift_h2 = $inhalt["uberschrift_h2"];
$text = $inhalt["text"];

$farbe = get_field("farbe");

$button = get_field("button");

$button_2 = get_field("button_2");
$button_2_aktivieren = $button_2["zweiten_button_aktivieren"];
$button_2_link = $button_2["link"];
$button_2_farbe = $button_2["farbe"];
?>



<div class="kunstangebot__item --color-<?= $farbe ?> <?= $reihenfolge ?>" id="<?= $id ?>">
    <div class="wrapper wrapper--big">

        <div class="item__image">
            <?php if (!empty($bilddatei)) : ?>
                <img class="image" src="<?= $bilddatei["url"]; ?>" alt="<?= $bilddatei["alt"] ?>">
            <?php endif; ?>
            <?php if (!empty($bilddatei) && !empty($maske)) : ?>
                <img class="image__mask" src="<?= $maske["url"]; ?>" alt="<?= $maske["alt"] ?>">
            <?php endif; ?>
            <?php if (!empty($bilddatei) && !empty($maske_mobile)) : ?>
                <img class="image__mask --mobile" src="<?= $maske_mobile["url"]; ?>" alt="<?= $maske_mobile["alt"] ?>">
            <?php endif; ?>
        </div>

        <div class="item__content">

            <?php if (!empty($anmerkung)) : ?>
                <div class="info__badge">
                    <div></div>
                    <p><?= $anmerkung ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($uberschrift_h2)) : ?>
                <h2>
                    <?= $uberschrift_h2 ?>
                    <?php if (!empty($uberschrift_h6)) : ?>
                        <span class="h6"><?= $uberschrift_h6 ?></span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($text)) : ?>
                <p><?= $text ?></p>
            <?php endif; ?>


            <p class="two-buttons-vertical">
                <a class="button --color-<?= $farbe ?>" href="<?= $button["url"]; ?>" target="<?= $button["target"]; ?>">
                    <span><?= $button["title"]; ?></span>
                </a>

                <?php if ($button_2_aktivieren) : ?>
                    <a class="button --color-<?= $button_2_farbe ?>" href="<?= $button_2_link["url"]; ?>" target="<?= $button_2_link["target"]; ?>">
                        <span><?= $button_2_link["title"]; ?></span>
                    </a>
                <?php endif; ?>
            </p>

            <p class="background__number"><?= $nummer ?></p>
        </div>

    </div>
</div>
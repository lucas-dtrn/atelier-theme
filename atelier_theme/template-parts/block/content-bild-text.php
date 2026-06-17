<?php
/**
 * Block Name: Bild & Text
 *
 */

// get fields
$reihenfolge = get_field( "reihenfolge" );
$bild = get_field( "bild" );
$inhalt = get_field( "inhalt" );

$text = $inhalt["text"];
$button = $inhalt["button"];
$button_farbe = $inhalt["button_farbe"];

$id = $block["id"];
?>



<div id="<?php echo $id; ?>" class="bild__text <?php echo esc_attr($reihenfolge); ?> wrapper">

    <?php if( !empty( $bild ) ): ?>
        <img class="bild__text__image" src="<?php echo esc_url($bild['url']); ?>" alt="<?php echo esc_attr($bild['alt']); ?>" />
    <?php endif; ?>

    <div class="bild__text__content">
    
        <?php if( !empty($text) ) : ?>
            <?php echo $text; ?>
        <?php endif; ?>

        <?php if( !empty($button) ) : ?>
            <a class="button  --color-<?= $button_farbe ?>" href="<?php echo $button["url"] ?>" target="<?php echo $button["target"]; ?>">
                <span><?php echo $button["title"]; ?></span>
            </a>
        <?php endif; ?>

    </div>

</div>
<?php
/**
 * Block Name: 3 Schritte
 *
 */

// get fields
$vorname = get_field('vorname');
$nachname = get_field('nachname');
$beruf = get_field('beruf');
$zitat = get_field('zitat');
$bild = get_field('bild');


$id = $block['id'];

?>


<div id="<?php echo $id; ?>" class="zitat">

    <div class="zitat__texts">
        <div class="header-image-mobile">
            <div class="name">
                <span class="text"><?php echo $vorname; ?></span>
                <span class="text"><?php echo $nachname; ?></span>
                <span class="job"><?php echo $beruf; ?></span>
            </div>
            <?php if( !empty( $bild ) ): ?>
                <img class="zitat__portrait _vp-mobile" src="<?php echo esc_url($bild['url']); ?>" alt="<?php echo esc_attr($bild['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="bubble">
            <p><?php echo $zitat; ?></p>
            <span class="q1">"</span>
            <span class="q2">"</span>
        </div>
    </div>
    <?php if( !empty( $bild ) ): ?>
        <img class="zitat__portrait _vp-desktop" src="<?php echo esc_url($bild['url']); ?>" alt="<?php echo esc_attr($bild['alt']); ?>" />
    <?php endif; ?>

</div>
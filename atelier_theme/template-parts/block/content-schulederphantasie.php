<?php

/**
 * Block Name: Schule der P>hantasie
 *
 */

// get fields
$text = get_field('text');
$link = get_field('link');

$id = $block['id'];


// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>

<div id="<?php echo $id; ?>" class="schulederphantasie">
    <img class="image openSchuldeDerPhantasie" src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_schulederphantasie.jpg" alt="Schule der Phantasie Logo">
    <p>Seit über 10 Jahren bin ich auch Dozentin an der Kinderkunstschule Schule der Phantasie. Das Atelier Kunst & Gestalten ist eine Außenstelle für den Landkreis Fürth.</p>
    <?php if (!empty($link)) : ?>
        <a class="link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" rel="noreferrer"><?php echo $link['title']; ?></a>
    <?php endif; ?>
</div>
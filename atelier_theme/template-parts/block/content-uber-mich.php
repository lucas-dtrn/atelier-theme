<?php
/**
 * Block Name: Über mich
 *
 */

// get fields
$bild = get_field("bild");
$name = get_field("name");
$titel = get_field("titel");
$zitat = get_field("zitat");
$id = $block["id"];
?>

<!-- <div id="<?php echo $id; ?>" class="sticky__split uber__mich">

    <div class="wrapper">

        <div class="sticky__element">
            
        </div>
        
        <div class="sticky__content">
            
        </div>

    </div>

</div> -->





<div id="<?php echo $id; ?>" class="uber__mich bild__text wrapper">

    <div class="bild__text__image">
        <img src="<?= $bild["url"] ?>">
        <span>
            <h2><?= $name ?></h2>
            <h6><?= $titel ?></h6>
        </span>
    </div>

    <div class="bild__text__content">
    
        <div class="quote__list">
            <div class="list__item">
                <?= $zitat ?>
                <div class="item__infos">
                    <img src="<?= get_template_directory_uri() ?>/img/website/testimonial_quote_bottom.svg">
                </div>
            </div>
        </div>

    </div>

</div>
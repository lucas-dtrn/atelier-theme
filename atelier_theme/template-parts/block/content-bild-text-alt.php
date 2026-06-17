<?php

/**
 * Block Name: Bild & Text
 *
 */

// get fields
$reihenfolge = get_field_object("reihenfolge");
$bild = get_field("bild");

$inhalt = get_field("inhalt");
$uberschrift_h6 = $inhalt["uberschrift_h6"];
$uberschrift_h2 = $inhalt["uberschrift_h2"];
$text = $inhalt["text"];
$button_liste = $inhalt["button_liste"];
$button = $inhalt["button"];

$id = $block["id"];
?>



<div id="<?php echo $id; ?>" class="media__text <?php echo esc_attr($reihenfolge); ?> wrapper">

    <div class="media__text__image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/discover_atelier.png" alt="">
    </div>

    <div class="media__text__content">

        <?php if (have_rows('inhalt')) : ?>
            <?php while (have_rows('inhalt')) : the_row(); ?>

                <?php if (!empty($uberschrift_h6)) : ?>
                    <h6><?php echo $uberschrift_h6; ?></h6>
                <?php endif; ?>

                <?php if (!empty($uberschrift_h2)) : ?>
                    <h2><?php echo $uberschrift_h2; ?></h2>
                <?php endif; ?>

                <?php if (!empty($text)) : ?>
                    <?php echo $text; ?>
                <?php endif; ?>

                <div class="button__list">
                    <div id="link--courses" class="button__link">
                        <a class="button button--mini  --color-gray  ">
                            <span>Regelmäßige Kunstkurse</span>
                        </a>
                        <a class="link">Termine einsehen<img src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/arrow_right_purple.svg" alt=""></a>
                    </div>
                    <div id="link--workshops" class="button__link">
                        <a class="button button--mini  --color-gray  ">
                            <span>Einmalige Kunstworkshops</span>
                        </a>
                        <a class="link">Termine einsehen<img src="<?php echo get_template_directory_uri(); ?>/assets/img/elements/arrow_right_red.svg" alt=""></a>
                    </div>
                    <div class="button__link">
                        <a class="button button--mini  --color-gray  ">
                            <span>Individuelle Kunstevents</span>
                        </a>
                    </div>
                    <div class="button__link">
                        <a class="button button--mini  --color-gray  ">
                            <span>Kreative Kindergeburtstage</span>
                        </a>
                    </div>
                </div>

                <!--            <?php if (have_rows('button_liste')) : ?>
                <div class="buttons__list">

                    <?php while (have_rows('button_liste')) : the_row();
                                        $sub_button = get_sub_field("button");
                                        $sub_link = get_sub_field("link");
                                        echo get_sub_field('button');
                    ?>
                        <div class="button__link">
                            <a class="button  --color-gray  " href="<?php echo $sub_button["url"]; ?>" target="<?php echo $sub_button["target"]; ?>">
                                <span><?php echo $sub_button["title"]; ?></span>
                            </a>
                            <?php if ($sub_link) : echo "test"; ?>
                            
                                <a class="link" href="<?php echo $sub_link["url"]; ?>" target="<?php echo $sub_link["target"]; ?>"><?php echo $sub_link["title"]; ?></a>
                            <?php endif; ?>
                        </div>

                    <?php endwhile; ?>

                </div>
            <?php endif; ?> -->

            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (!empty($button)) : ?>
            <a class="button  --color-main  " href="<?php echo $button["url"] ?>">
                <span><?php echo $button["title"]; ?></span>
            </a>
        <?php endif; ?>
    </div>


</div>
<?php
/*------------------------------------*/
/* Block name: Atelier Entdecken */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$uberschrift_h6 = get_field("uberschrift_h6");
$uberschrift_h2 = get_field("uberschrift_h2");
$text = get_field("text");
$button = get_field("button");
?>

<div id="<?php echo $id; ?>" class="discover__atelier">

    <div class="discover__atelier__content">

        <?php if (!empty($uberschrift_h6)) : ?>
            <h6><?php echo $uberschrift_h6; ?></h6>
        <?php endif; ?>

        <?php if (!empty($uberschrift_h2)) : ?>
            <h2><?php echo $uberschrift_h2; ?></h2>
        <?php endif; ?>

        <?php if (!empty($text)) : ?>
            <p><?php echo $text; ?></p>
        <?php endif; ?>

        <?php if (have_rows('buttons')) : ?>
            <div class="shop__button__list">
                <?php while (have_rows('buttons')) : the_row();
                    $buttons_button = get_sub_field('buttons_button');
                ?>
                    <a class="button  --color-gray  " href="<?php echo $buttons_button["url"]; ?>">
                        <span><?php echo $buttons_button["title"]; ?></span>
                    </a>
                <?php
                endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($button)) : ?>
            <a class="button  --color-main  " href="<?php echo $button["url"] ?>">
                <span><?php echo $button["title"]; ?></span>
            </a>
        <?php endif; ?>

    </div>

    <div class="discover__atelier__image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/discover_atelier" alt="">
    </div>

</div>
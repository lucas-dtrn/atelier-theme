<?php
/**
 * Block Name: Produktslider
 *
 */

// get fields
$uberschrift_h5 = get_field('uberschrift_h5');
$uberschrift_h2 = get_field('uberschrift_h2');
$inhalte = get_field('inhalte');
$inhal = get_field('inhal');
$button = get_field('button');

$id = $block['id'];
?>

<div id="<?php echo $id; ?>" class="produktslider">


    <?php if( $uberschrift_h5 || $uberschrift_h2 || $button ) : ?>
        <div class="produktslider__header inner">
            <div>
                <?php if( !empty( $uberschrift_h5 ) ) : ?>
                    <h5><?php echo $uberschrift_h5; ?></h5>
                <?php endif; ?>
                <?php if( !empty( $uberschrift_h2 ) ) : ?>
                    <h2><?php echo $uberschrift_h2; ?></h2>
                <?php endif; ?>
            </div>
            <?php if( !empty( $button )): ?>
                <?php get_template_part('template-parts/button', '', array( 'button'=>$button )); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="slider__container">
        <div class="slider">

            <?php
            $auswahl = get_field('auswahl');
            if( $auswahl ): ?>
                <?php foreach( $auswahl as $post ): 
                    $permalink = get_permalink( $post->ID );
                    $title = get_the_title( $post->ID );
                    $short_description = get_field( 'short_description', $post->ID );
                    $category = wp_get_post_terms( $post->ID, 'product_cat' )[0]->name;
                    $product = wc_get_product( $post->ID );

                    if ($product->get_status() === 'publish') :
                        $product_status = $product->get_status();
                        $images = $product->get_gallery_image_ids();
                        $image_main = get_the_post_thumbnail_url($post->ID, 'woocommerce_thumbnail');
                        $image_zoom = wp_get_attachment_image_src($images[0], 'woocommerce_thumbnail')[0];
                        $price = $product->get_price();
                        $regular_price = $product->get_regular_price();

                        if ($product->product_type === 'variable') {
                            $available_variations = $product->get_available_variations();
                            $variation_id=$available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
                            $variable_product1= new WC_Product_Variation( $variation_id );
                            $regular_price = $variable_product1->regular_price;
                        }
                        ?>

                        <li class="product product-list__item">

                            <a href="<?= $permalink ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" aria-label="Produkt '<?= $title ?>' ansehen">
                                <img class="attachment-woocommerce_thumbnail" src="<?= $image_main; ?>" alt="">
                                <img class="hover-image" src="<?= $image_zoom; ?>" alt="">
                            </a>

                            <div class="loop__product__content">
                                <a href="<?= $permalink ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" aria-label="Produkt '<?= $title ?>' ansehen">
                                    <span class="product__category"><?= $category ?></span>
                                    <h3 class="woocommerce-loop-product__title"><?= $title ?></h3>
                                    <p class="product__description"><?= $short_description ?></p>
                                    <?php woocommerce_atelier_product_badges( $post->ID ); ?>

                                    <?php if (!$product->is_on_sale()) : ?>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><bdi><?= $price ?>&nbsp;<span class="woocommerce-Price-currencySymbol">€</span></bdi></span></span>
                                    <?php else: ?>
                                        <span class="price"><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><?= $regular_price ?>&nbsp;<span class="woocommerce-Price-currencySymbol">€</span></bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi><?= $price ?>&nbsp;<span class="woocommerce-Price-currencySymbol">€</span></bdi></span></ins></span>
                                    <?php endif; ?>

                                </a>
                                <a href="?add-to-cart=<?= $post->ID ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart button__loop" data-product_id="<?= $post->ID ?>" data-product_sku="" aria-label="„<?= $title ?>“ zu deinem Warenkorb hinzufügen" rel="nofollow">In den Warenkorb</a>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if( have_rows('kategorien') ): ?>
                <?php while( have_rows('kategorien') ) : the_row();
                    $inhalt = get_sub_field('inhalt');
                    $term = get_term($inhalt);
                    $link = get_term_link($inhalt);
                    $name = $term->name;
                    $thumbnail_id = get_term_meta( $inhalt, 'thumbnail_id', true ); 
                    // $attr = apply_filters( 'wp_get_attachment_image_attributes', array('alt'), $inhalt, 'medium' );
                    $bild = wp_get_attachment_image_url( $thumbnail_id, 'medium' ); 
                    // d(wp_get_attachment_image( $thumbnail_id, 'medium' ));
                    ?>

                    <a href="<?php echo $link; ?>" aria-label="Alle Produkte der Kategorie '<?= $name ?>' ansehen"><div class="slider__item">
                        <?php // echo wp_get_attachment_image( $thumbnail_id, 'medium', false, array('sizes'=>'medium') ); ?>
                        <img class="item__background" src="<?= $bild ?>" alt="">

                        <div class="item__title">
                            <h3><?php echo $name; ?></h3>
                        </div>

                        <div class="item__gradient"></div>
                    </div></a>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>

        <div class="slider__controls"></div>
    </div>

</div>
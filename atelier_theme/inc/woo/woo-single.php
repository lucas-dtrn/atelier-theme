<?php
/*------------------------------------*/
/* Woocoommerce single */
/*------------------------------------*/

// Badge with link to edit the product
function atelier_edit_link() {
    // If can edit product
    if (current_user_can('edit_posts')) {
        global $post;
        $edit_link = get_edit_post_link($post->ID);
        echo '<div class="admin-edit-link message --admin" target="_blank">Admin-Ansicht<a href="' . $edit_link . '">Produkt bearbeiten</a></div>';
    }
}

// Custom product title
function wvnderlab_single_title() {
    global $post;
    $categories = get_the_terms($post->ID, 'product_cat');
    $category = $categories[0];
    $category_name = get_field('singular_name', $category->taxonomy . '_' . $category->term_id) ?? $category->name;
    $product = wc_get_product($post->ID);

    echo '<h1 class="product_title entry-title"><span style="font-size:0;">' . $category_name . ' </span>' . $product->get_title() . '</h1>';
}

// Replace product image gallery
function at_woo_product_gallery() {
    global $product;

    $galleryImages = $product->get_gallery_image_ids(); // get gallery images 
    $mainImage = $product->get_image_id(); // get product main image 

    // Merge all images
    $productImages = array_merge(
        [$mainImage],
        $galleryImages
    );

    get_template_part('components/shop/product-gallery', NULL, array('imageIds' => $productImages));
}

// Change number of related products
function jk_related_products_args($args) {
    $args['columns'] = 1; // arranged in 1 columns
    $args['posts_per_page'] = 6; // 6 related products
    return $args;
}

// Sgort description
function atelier_custom_field_short_description() {
    global $product;
    $short_description = get_field("short_description", $product->get_id());
    // $short_description = get_the_excerpt( $product->get_id() );
    if (!empty($short_description)) {
?>
        <span class="short__description"><?= $short_description ?></span>
    <?php
    }
}

// Delivery info
function atelier_custom_field_delivery_info() {
    ?>
    <p class="delivery__info"><?php echo get_field("versandinformationen_kurz", "options"); ?></p>
    <?php
}

// Quote
function atelier_custom_field_quote() {
    $spruch_aktivieren = get_field('spruch_aktivieren');
    $spruch_uberschrift = get_field('spruch_uberschrift');
    $spruch = get_field('spruch');
    if ($spruch_aktivieren && $spruch) : ?>
        <div class="product__quote">
            <h4><?= $spruch_uberschrift ?></h4>
            <div>
                <blockquote><?= $spruch ?></blockquote>
            </div>
        </div>
    <?php endif;
}

// Bulletpoints
function atelier_custom_field_bulletpoints() {
    global $product;
    $uberschrift = get_field('uberschrift');
    if (!empty($uberschrift) || have_rows('stichpunkte')) : ?>
        <div class="product__bulletpoints">
            <?php //echo $product->get_short_description(); 
            ?>
            <?php if (!empty($uberschrift)) : ?>
                <h4><?php echo $uberschrift; ?></h4>
            <?php endif;
            if (have_rows('stichpunkte')) : ?>
                <ul>
                    <?php while (have_rows('stichpunkte')) : the_row();
                        $punkt = get_sub_field('punkt');
                    ?>
                        <li>
                            <img class="--ll-disabled" src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/bullet_checkmark.svg" alt="">
                            <span><?php echo $punkt; ?></span>
                        </li>
                    <?php
                    endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php
    endif;
}

// Accordeon
function atelier_custom_field_accordeon() { ?>
    <div class="accordeon">
        <?php global $product; ?>
        <?php $firstAccordeon = true; ?>

        <?php if (!empty(get_field("lieferumfang"))) : ?>
            <div class="accordeon__item accordeon--lieferumfang <?= $firstAccordeon === true ? 'accordeon__item--opened' : '' ?>">
                <dt class="accordeon__header">
                    <h5>Lieferumfang</h5>
                </dt>
                <dd class="accordeon__content-new">
                    <div class="content">
                        <div>
                            <?php if (have_rows('lieferumfang')) : ?>
                                <ul>
                                    <?php while (have_rows('lieferumfang')) : the_row();
                                        $inhalt = get_sub_field('inhalt');
                                    ?>
                                        <li><?php echo $inhalt; ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if (have_rows('weiteres_material')) : ?>
                                <h5>Weiteres Material</h5>
                                <ul>
                                    <?php while (have_rows('weiteres_material')) : the_row();
                                        $inhalt = get_sub_field('inhalt');
                                    ?>
                                        <li><?php echo $inhalt; ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="content__logotext">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_kunsttuete_hell.svg" alt="Kunsttüte Logo">
                            <p>Eine ganz neue Möglichkeit seine Kreativität Zuhause auszuleben!</p>
                        </div>
                    </div>
                </dd>
            </div>
            <?php $firstAccordeon = false; ?>
        <?php endif; ?>

        <?php if ($product->get_description() !== "") : ?>
            <div class="accordeon__item <?= $firstAccordeon === true ? 'accordeon__item--opened' : '' ?>">
                <dt class="accordeon__header">
                    <h5>Beschreibung</h5>
                </dt>
                <dd class="accordeon__content-new">
                    <div class="content">
                        <?= wpautop($product->get_description()); ?>
                    </div>
                </dd>
            </div>
            <?php $firstAccordeon = false; ?>
        <?php endif; ?>

        <?php if ($product->has_dimensions()) : ?>
            <div class="accordeon__item <?= $firstAccordeon === true ? 'accordeon__item--opened' : '' ?>">
                <dt class="accordeon__header">
                    <h5>Produktgröße<?php /* echo __( 'Dimensions', 'woocommerce' ); */ ?></h5>
                </dt>
                <dd class="accordeon__content-new">
                    <div class="content">
                        <ul>
                            <?php
                            $dimensions = $product->get_dimensions(false);
                            if ($dimensions["length"] != "") :
                            ?> <li><strong>Länge:</strong> <?php echo $dimensions["length"]; ?>cm</li> <?php
                                                                                                    endif;
                                                                                                    if ($dimensions["width"] != "") :
                                                                                                        ?> <li><strong>Breite:</strong> <?php echo $dimensions["width"]; ?>cm</li> <?php
                                                                                                                                                                                endif;
                                                                                                                                                                                if ($dimensions["height"] != "") :
                                                                                                                                                                                    ?> <li><strong>Höhe:</strong> <?php echo $dimensions["height"]; ?>cm</li> <?php
                                                                                                                                                                                                                                                            endif;
                                                                                                                                                                                                                                                                ?>
                        </ul>
                    </div>
                </dd>
            </div>
            <?php $firstAccordeon = false; ?>
        <?php endif; ?>

        <?php if (!empty(get_field("versandinformationen_lang", "options"))) : ?>
            <div class="accordeon__item <?= $firstAccordeon === true ? 'accordeon__item--opened' : '' ?>">
                <dt class="accordeon__header">
                    <h5>Versand & Rückversand</h5>
                </dt>
                <dd class="accordeon__content-new">
                    <div class="content">
                        <?php echo get_field("versandinformationen_lang", "options") ?>
                    </div>
                </dd>
            </div>
            <?php $firstAccordeon = false; ?>
        <?php endif; ?>

        <?php if (have_rows('kacheln')) :
            while (have_rows('kacheln')) : the_row();
                $uberschrift = get_sub_field('uberschrift');
                $inhalt = get_sub_field('inhalt'); ?>

                <?php if (empty($uberschrift) || empty($inhalt)) continue; ?>

                <div class="accordeon__item <?= $firstAccordeon === true ? 'accordeon__item--opened' : '' ?>">
                    <dt class="accordeon__header">
                        <h5><?php echo $uberschrift; ?></h5>
                    </dt>
                    <dd class="accordeon__content-new">
                        <div class="content">
                            <?php echo $inhalt; ?>
                        </div>
                    </dd>
                </div>

        <?php endwhile;
            $firstAccordeon = false;
        endif; ?>

    </div> <?php
        }






        //Warenkorb - Item Mengenauswahl als Select Input
        function woocommerce_quantity_input($args = array(), $product = null, $echo = true) {

            if (is_null($product)) {
                $product = $GLOBALS['product'];
            }

            $defaults = array(
                'input_id' => uniqid('quantity_'),
                'input_name' => 'quantity',
                'input_value' => '1',
                'classes' => apply_filters('woocommerce_quantity_input_classes', array('input-text', 'qty', 'text'), $product),
                'max_value' => apply_filters('woocommerce_quantity_input_max', -1, $product),
                'min_value' => apply_filters('woocommerce_quantity_input_min', 0, $product),
                'step' => apply_filters('woocommerce_quantity_input_step', 1, $product),
                'pattern' => apply_filters('woocommerce_quantity_input_pattern', has_filter('woocommerce_stock_amount', 'intval') ? '[0-9]*' : ''),
                'inputmode' => apply_filters('woocommerce_quantity_input_inputmode', has_filter('woocommerce_stock_amount', 'intval') ? 'numeric' : ''),
                'product_name' => $product ? $product->get_title() : '',
            );

            $args = apply_filters('woocommerce_quantity_input_args', wp_parse_args($args, $defaults), $product);


            $args['min_value'] = max($args['min_value'], 0);
            $args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : 20;

            if ('' !== $args['max_value'] && $args['max_value'] < $args['min_value']) {
                $args['max_value'] = $args['min_value'];
            }

            $options = '';

            for ($count = $args['min_value']; $count <= $args['max_value']; $count = $count + $args['step']) {

                if ('' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value']) {
                    $selected = 'selected';
                } else $selected = '';

                $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
            }

            $string = '<div class="quantity"><span>Menge:</span><select name="' . $args['input_name'] . '">' . $options . '</select></div>';

            if ($echo) {
                echo $string;
            } else {
                return $string;
            }
        }






        add_filter('woocommerce_product_variation_title_include_attributes', 'custom_product_variation_title', 10, 2);
        function custom_product_variation_title($should_include_attributes, $product) {
            $should_include_attributes = false;
            return $should_include_attributes;
        }







        add_filter('woocommerce_account_menu_items', 'remove_my_account_links');
        function remove_my_account_links($menu_links) {
            // unset( $menu_links['dashboard'] ); // Remove Logout link
            unset($menu_links['customer-logout']); // Remove Logout link
            return $menu_links;
        }





        // Unterkategorien am Anfang der Kategorieseiten
        function atelier_product_subcategories($args = array()) {
            $parentid = get_queried_object_id();
            $args = array(
                'parent' => $parentid
            );
            $terms = get_terms('product_cat', $args);
            if ($terms) : ?>
        <div class="shop__button__list shop__subcategories">
            <p class="h4">Unterkategorien</p>
            <ul>
                <?php foreach ($terms as $term) : ?>
                    <li>
                        <a class="button  --color-gray   <?php echo $term->slug; ?>" href="<?php echo esc_url(get_term_link($term)); ?>">
                            <span><?php echo $term->name; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif;
        }
        // add_action('woocommerce_archive_description', 'atelier_product_subcategories', 20);
        add_action('woocommerce_before_shop_loop', 'atelier_product_subcategories', 100);
        // add_action('woocommerce_shop_loop', 'atelier_product_subcategories', 20);





        // Unterkategorien am Ende der Kategorieseiten
        function tutsplus_product_subcategories($args = array()) {
            if (is_product_category()) {
                $parentid = get_queried_object_id();
                $args = array(
                    'parent' => $parentid
                );
                $terms = get_terms('product_cat', $args);
                if ($terms) {
        ?>
            <div class="wrapper --ignore shop__category__suggestions">
                <?php get_template_part('components/paper'); ?>
                <div class="wrapper">
                    <h2>Mehr<br><?php echo single_cat_title('', false); ?><br>entdecken
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/more_categories_background.svg" alt="">
                    </h2>
                    <div class="category__suggestions__items">
                        <?php
                        $i = 1;
                        foreach ($terms as $term) {
                            if ($i <= 4) { ?>
                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="<?php echo $term->slug; ?>">
                                    <div><?php woocommerce_subcategory_thumbnail($term); ?></div>
                                    <h4><strong><?php echo $term->name; ?></strong></h4>
                                </a> <?php
                                        $i++;
                                    }
                                } ?>
                    </div>
                </div>
            </div>
        <?php
                }
            }
        }




        function cw_discount() {
            global $woocommerce;
            $cw_discount = 0;
            $cart = WC()->cart;

            // Get id of the selected shipping method
            $isLocalPickup = WC()->session->get('chosen_shipping_methods')[0] == 'local_pickup:14';

            foreach ($woocommerce->cart->get_cart() as $cw_cart_key => $values) {
                $_product = $values['data'];
                if ($_product->is_on_sale()) {
                    $regular_price = $_product->get_regular_price();
                    $sale_price = $_product->get_sale_price();
                    $discount = ($regular_price - $sale_price) * $values['quantity'];
                    $cw_discount += $discount;
                }
            }
            if ($cw_discount > 0 || count(WC()->cart->get_applied_coupons()) > 0) : ?>
        <span class="total__savings"><?= get_template_part('components/icon', '', array('icon' => 'tag', 'color' => 'red')); ?>Deine Ersparnis<?php echo wc_price($cw_discount + $woocommerce->cart->discount_cart); ?></span>
    <?php endif; ?>

    <?php if ($cart->get_shipping_total() == 0 && !$isLocalPickup) : ?>
        <span class="total__savings"><?= get_template_part('components/icon', '', array('icon' => 'tag', 'color' => 'red')); ?>Kostenloser Versand<?php echo wc_price($cart->get_shipping_total()); ?></span>
<?php endif;
        }




        function acf_filter_rest_api_preload_paths($preload_paths) {
            if (!get_the_ID()) {
                return $preload_paths;
            }
            $remove_path = '/wp/v2/' . get_post_type() . 's/' . get_the_ID() . '?context=edit';
            $v1 =  array_filter(
                $preload_paths,
                function ($url) use ($remove_path) {
                    return $url !== $remove_path;
                }
            );
            $remove_path = '/wp/v2/' . get_post_type() . 's/' . get_the_ID() . '/autosaves?context=edit';
            return array_filter(
                $v1,
                function ($url) use ($remove_path) {
                    return $url !== $remove_path;
                }
            );
        }
        add_filter('block_editor_rest_api_preload_paths', 'acf_filter_rest_api_preload_paths', 10, 1);










        /**
         * Hide shipping rates when free shipping is available, but keep "Local pickup" 
         * Updated to support WooCommerce 2.6 Shipping Zones
         */

        function hide_shipping_when_free_is_available($rates, $package) {
            $new_rates = array();
            foreach ($rates as $rate_id => $rate) {
                // Only modify rates if free_shipping is present.
                if ('free_shipping' === $rate->method_id) {
                    $new_rates[$rate_id] = $rate;
                    break;
                }
            }

            if (!empty($new_rates)) {
                //Save local pickup if it's present.
                foreach ($rates as $rate_id => $rate) {
                    if ('local_pickup' === $rate->method_id) {
                        $new_rates[$rate_id] = $rate;
                        break;
                    }
                }
                return $new_rates;
            }

            return $rates;
        }

        add_filter('woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2);





        add_action('woocommerce_before_shop_loop_item_title', 'neueFunktion', 20);
        function neueFunktion() {
            global $product;

            $attachment_ids = $product->get_gallery_image_ids();

            $image_link = wp_get_attachment_image_url($attachment_ids[0], 'medium');

            echo '<img class="hover-image" src="' . $image_link . '" alt="">';
        }







        /*------------------------------------*/
        /* Hooks */
        /*------------------------------------*/
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

        add_action('woocommerce_before_single_product_summary', 'at_woo_product_gallery', 20);
        add_action('woocommerce_single_product_summary', 'atelier_edit_link', 0);
        add_action('woocommerce_single_product_summary', 'woocommerce_atelier_product_badge', 2);
        add_action('woocommerce_single_product_summary', 'wvnderlab_single_title', 5);
        add_action('woocommerce_single_product_summary', 'atelier_custom_field_short_description', 8);
        add_action('woocommerce_single_product_summary', 'atelier_custom_field_delivery_info', 35);
        add_action('woocommerce_single_product_summary', 'atelier_custom_field_bulletpoints', 45);
        add_action('woocommerce_single_product_summary', 'atelier_custom_field_quote', 46);
        add_action('woocommerce_single_product_summary', 'atelier_custom_field_accordeon', 47);

        add_filter('woocommerce_output_related_products_args', 'jk_related_products_args');

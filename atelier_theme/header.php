<?php
// Save environment variables in $_ENV
$_ENV = include ($_SERVER['DOCUMENT_ROOT'] . '/config/env.php') ?? false;
// if (WP_DEBUG) d($_ENV);

/*------------------------------------*/
/* 	Define website mode depending on page
/*------------------------------------*/
if (is_page('shop') || is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() || is_page('sendungsverfolgung')) {
    $setWebsiteMode = 'shop';
} else {
    $setWebsiteMode = 'atelier';
}

// // override websiteMode with ACF field
// $seitenkategorie = get_field('seitenkategorie');
// if(isset($seitenkategorie)) $setWebsiteMode = $seitenkategorie;

// override websiteMode with URL parameter
if (isset($_GET['websiteMode'])) $setWebsiteMode = $_GET['websiteMode'];

global $websiteMode;
$websiteMode = $setWebsiteMode; // Passe den Wert der globalen Variable an

/*------------------------------------*/
/* 	Section Name
/*------------------------------------*/
$headerHiddenOnLoad = true;

// ceck if page is 404
if (is_404()) $headerHiddenOnLoad = false;

// // get page id
// $page_id = get_queried_object_id();
// if (get_field('header_anfangs_verstecken', $page_id)) $header_hidden = "--hidden-on-load";
?>


<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
                                        echo ' :';
                                    } ?> <?php bloginfo('name'); ?></title>

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon.svg">
    <link rel="icon" type="image/ico" sizes="256x256" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon.ico">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta name="theme-color" content="#00162e">

    <?php wp_head(); ?>

    <?php if (is_page('buchung')) : ?>
        <script type="text/javascript" src="<?= get_template_directory_uri() ?>/js/pages/booking.js" defer></script>
    <?php endif; ?>

    <?php if (is_page('galerie')) : ?>
        <script type="text/javascript" src="<?= get_template_directory_uri() ?>/js/pages/gallery.js" defer></script>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>

    <?php get_template_part('template-parts/booking-reminder') ?>

    <div id='website-mode' data-website-mode="<?= $websiteMode ?>"></div>

    <header class="header <?= $headerHiddenOnLoad ? '--hidden-on-load' : '' ?> <?= is_page("Kunstangebote") ? "--hidden" : ''; ?> header--<?= $websiteMode ?>" data-show-offset="<?= $header_hidden_offset ?>">

        <?php get_template_part('template-parts/header-bar', '', array('type' => $websiteMode, 'nav' => true)); ?>

        <div class="header__dropdown header__dropdown__mobile" style="display:none;">

            <div class="dropdown__links">
                <?php if ($websiteMode === 'atelier') :
                    custom_menu_theme_mobile_big("atelier-header-menu-mobile-first");
                elseif ($websiteMode === 'shop') :
                    custom_menu_theme_mobile_big("shop-header-menu-mobile-first");
                endif; ?>
            </div>

            <div class="dropdown__dark">
                <?php if ($websiteMode === 'atelier') :
                    custom_menu_theme_mobile_small("atelier-header-menu-mobile-second");
                elseif ($websiteMode === 'shop') :
                    custom_menu_theme_mobile_small("shop-header-menu-mobile-second");
                endif; ?>

                <?php law_nav(); ?>

                <?php echo get_paper_structure(); ?>
            </div>

        </div>

    </header>

    <main id="main">
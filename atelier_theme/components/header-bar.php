<?php
$type = $args['type'] ?? 'atelier';
$nav = $args['nav'] ?? false;
$color = $args['color'] ?? 'main';
$drop = $args['drop'] ?? true;
$hero = $args['hero'] ?? false;
$hero = $hero ? 'true' : 'false';

if ($type !== 'atelier' && $type !== 'shop') $type = 'atelier';

if ($type === 'atelier') {
    $homeUrl = home_url();
} elseif ($type === 'shop') {
    $homeUrl = get_permalink(get_page_by_path('shop'));
}
?>

<div class="header-bar --color-<?= $color ?> --hero-<?= $hero ?>">

    <?php if ($nav) : ?>
        <nav class="wrapper">
        <?php else : ?>
            <div class="wrapper">
            <?php endif; ?>

            <?php if ($type === 'atelier') : ?>

                <div class="nav">
                    <?php atelier_nav_left(); ?>
                </div>

                <div class="header-logo-container">
                    <?php if ($color === 'main') : ?>
                        <a class="header-logo <?php if ($drop) {
                                                    echo 'header-logo--shifted';
                                                } ?>" href="<?= $homeUrl ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_4.svg" height="85" width="85" alt="Atelier Kunst & Gestalten Logo"></a>
                    <?php else : ?>
                        <a class="header-logo <?php if ($drop) {
                                                    echo 'header-logo--shifted';
                                                } ?>" href="<?= $homeUrl ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_4_light.svg" height="85" width="85" alt="Atelier Kunst & Gestalten Logo"></a>
                    <?php endif; ?>
                    <?php if ($drop) : ?>
                        <img class="header-drop _vp-desktop" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='156.474' height='44' viewBox='0 0 156.474 44'%3E%3Cpath id='Differenzmenge_36' data-name='Differenzmenge 36' d='M960,126a62.968,62.968,0,0,1-54.279-31h-.055a28.348,28.348,0,0,0-9.948-9.315A29.157,29.157,0,0,0,882,82l156.474,0a29.176,29.176,0,0,0-14,3.572A28.34,28.34,0,0,0,1014.326,95h-.047A63.391,63.391,0,0,1,991.7,117.458,62.714,62.714,0,0,1,960,126Z' transform='translate(-882 -82)' fill='%23fff'/%3E%3C/svg%3E%0A" alt="">
                        <img class="header-drop _vp-mobile" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='131' height='31.999' viewBox='0 0 131 31.999'%3E%3Cpath id='Schnittmenge_7' data-name='Schnittmenge 7' d='M248.969,104.544a53.932,53.932,0,0,1-21.6-10.645,54.36,54.36,0,0,1-8.4-8.524h-.076a28.736,28.736,0,0,0-9.905-8.124,29.047,29.047,0,0,0-6.223-2.245A29.555,29.555,0,0,0,196,74.211V74H327v.209h-.052a29.5,29.5,0,0,0-6.941.824,28.929,28.929,0,0,0-6.325,2.336,28.635,28.635,0,0,0-9.981,8.409,54.383,54.383,0,0,1-18.426,14.736,53.8,53.8,0,0,1-11.381,4.059,54.569,54.569,0,0,1-24.926-.031Z' transform='translate(-196 -74.003)' fill='%23fff'/%3E%3C/svg%3E%0A" alt="">
                    <?php endif; ?>
                </div>

                <div class="nav">
                    <?php atelier_nav_right(); ?>
                </div>

                <div class="hamburger hamburger--squeeze _vp-mobile">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>

            <?php else : ?>

                <div class="hamburger hamburger--squeeze _vp-mobile">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>

                <div class="nav _vp-desktop _vp-flex">
                    <?php shop_nav_left(); ?>
                </div>

                <div class="header-logo-container">
                    <?php if ($color === 'main') : ?>
                        <a class="header-logo <?php if ($drop) {
                                                    echo 'header-logo--shifted';
                                                } ?>" href="<?= $homeUrl ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_4.svg" height="85" width="85" alt="Atelier Kunst & Gestalten Logo"></a>
                    <?php else : ?>
                        <a class="header-logo <?php if ($drop) {
                                                    echo 'header-logo--shifted';
                                                } ?>" href="<?= $homeUrl ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logos/logo_4_light.svg" height="85" width="85" alt="Atelier Kunst & Gestalten Logo"></a>
                    <?php endif; ?>
                    <?php if ($drop) : ?>
                        <img class="header-drop _vp-desktop" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='156.474' height='44' viewBox='0 0 156.474 44'%3E%3Cpath id='Differenzmenge_36' data-name='Differenzmenge 36' d='M960,126a62.968,62.968,0,0,1-54.279-31h-.055a28.348,28.348,0,0,0-9.948-9.315A29.157,29.157,0,0,0,882,82l156.474,0a29.176,29.176,0,0,0-14,3.572A28.34,28.34,0,0,0,1014.326,95h-.047A63.391,63.391,0,0,1,991.7,117.458,62.714,62.714,0,0,1,960,126Z' transform='translate(-882 -82)' fill='%23fff'/%3E%3C/svg%3E%0A" alt="">
                        <img class="header-drop _vp-mobile" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='131' height='31.999' viewBox='0 0 131 31.999'%3E%3Cpath id='Schnittmenge_7' data-name='Schnittmenge 7' d='M248.969,104.544a53.932,53.932,0,0,1-21.6-10.645,54.36,54.36,0,0,1-8.4-8.524h-.076a28.736,28.736,0,0,0-9.905-8.124,29.047,29.047,0,0,0-6.223-2.245A29.555,29.555,0,0,0,196,74.211V74H327v.209h-.052a29.5,29.5,0,0,0-6.941.824,28.929,28.929,0,0,0-6.325,2.336,28.635,28.635,0,0,0-9.981,8.409,54.383,54.383,0,0,1-18.426,14.736,53.8,53.8,0,0,1-11.381,4.059,54.569,54.569,0,0,1-24.926-.031Z' transform='translate(-196 -74.003)' fill='%23fff'/%3E%3C/svg%3E%0A" alt="">
                    <?php endif; ?>
                </div>

                <div class="nav">
                    <a class="button --color-<?php if ($color === 'main') {
                                                    echo 'gray';
                                                } else {
                                                    echo 'main-light';
                                                } ?>   nav__account__link" href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>">

                        <?php if (!is_user_logged_in()) : ?>
                            <span>Anmelden</span>
                        <?php else :
                            $current_user = wp_get_current_user();
                        ?>
                            <span><?php echo $current_user->display_name; ?></span>
                        <?php endif; ?>

                        <?php if ($color === 'main') : ?>
                            <img class="nav__cart__icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/icon_account_main.svg" alt="Konto ansehen">
                        <?php else : ?>
                            <img class="nav__cart__icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/icon_account_white.svg" alt="Konto ansehen">
                        <?php endif; ?>

                    </a>

                    <a class="nav__cart__link" href="<?php echo wc_get_cart_url(); ?>">
                        <?php global $woocommerce;
                        if ($woocommerce->cart->cart_contents_count != "0") : ?>
                            <div class="nav__cart__quantity"><span><?php
                                                                    echo $woocommerce->cart->cart_contents_count;
                                                                    ?></span></div>
                        <?php endif; ?>

                        <?php if ($color === 'main') : ?>
                            <img class="nav__cart__icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/icon_cart_main.svg" alt="Warenkorb Öffnen">
                        <?php else : ?>
                            <img class="nav__cart__icon" src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/icon_cart_white.svg" alt="Warenkorb Öffnen">
                        <?php endif; ?>
                    </a>

                    <?php shop_nav_right(); ?>
                </div>

            <?php endif; ?>

            <?php if ($nav) : ?>
        </nav>
    <?php else : ?>
</div>
<?php endif; ?>

</div>
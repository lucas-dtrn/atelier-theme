<?php
/*------------------------------------*/
/* Woocoommerce account */
/*------------------------------------*/

// Remove "Dashboard" button from account navigation
function atelier_woocommerce_edit_account_nav($menu_links) {

    unset($menu_links['dashboard']); // Remove Dashboard
    //unset( $menu_links[ 'payment-methods' ] ); // Remove Payment Methods
    //unset( $menu_links[ 'orders' ] ); // Remove Orders
    //unset( $menu_links[ 'downloads' ] ); // Disable Downloads
    // unset( $menu_links[ 'edit-address' ] ); // Addresses
    //unset( $menu_links[ 'edit-account' ] ); // Remove Account details tab
    //unset( $menu_links[ 'customer-logout' ] ); // Remove Logout link

    return $menu_links;
}

/*------------------------------------*/
/* Hooks */
/*------------------------------------*/
add_action('woocommerce_account_menu_items', 'atelier_woocommerce_edit_account_nav');

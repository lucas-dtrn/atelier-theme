<?php
require get_template_directory() . '/inc/variables.php'; //
require get_template_directory() . '/inc/helpers.php'; // Helper functions
require get_template_directory() . '/inc/settings.php'; //
require get_template_directory() . '/inc/assets.php'; //
require get_template_directory() . '/inc/menu.php'; //
require get_template_directory() . '/inc/blocks.php'; //
require get_template_directory() . '/inc/custom-post-type.php'; //
require get_template_directory() . '/inc/api.php'; // API functions
require get_template_directory() . '/inc/dates.php'; // Dates admin list
require get_template_directory() . '/inc/acf.php'; //
require get_template_directory() . '/inc/admin-list.php'; //
require get_template_directory() . '/inc/cleanup.php'; //
require get_template_directory() . '/inc/misc.php'; //
require get_template_directory() . '/inc/contactform7.php'; //
require get_template_directory() . '/inc/cron.php'; // Cron functions
require get_template_directory() . '/inc/ajax.php'; // ajax
require get_template_directory() . '/inc/widgets.php'; // Widgets


// import all files from /inc/utils
foreach (glob(get_template_directory() . '/inc/utils/*.php') as $filename) {
    require $filename;
}

// require all files in the /woo folder
foreach (glob(get_template_directory() . '/inc/woo/*.php') as $file) {
    require_once $file;
}

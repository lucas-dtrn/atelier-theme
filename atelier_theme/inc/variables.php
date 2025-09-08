<?php
$_ENV = include($_SERVER['DOCUMENT_ROOT'] . '/config/env.php');
define("ENV", $_ENV['ENV']);

if (ENV === 'development') {
    // define("BOOK_URL", "https://dev.buchung.atelier-delatron.de");
    define("BOOK_URL", "https://buchung.atelier-delatron.de");
} else {
    define("BOOK_URL", "https://buchung.atelier-delatron.de");
}

// In functions.php oder einem benutzerdefinierten Theme-Plugin
function custom_setup_globals()
{
    global $websiteMode;
    $websiteMode = 'atelier';
}
add_action('init', 'custom_setup_globals');



if (ENV === 'development') {
} else {
}

<?php
session_start();
get_header(); /* Template Name: Buchung */

include('Models/Database.php');
$db = new Database;

// Safe GET parameters as variables
foreach ($_GET as $param => $value) {
    ${$param} = $value;
}


// Get Fields
$product_id = $_GET['product_id'];
$product_title = get_field("title", $product_id);
$product_category = get_the_category($product_id)[0]->name;
$product_price = get_field("price", $product_id);

$product_group = get_field("group", $product_id);
if ($product_group === "child") $product_group = "Kinder";
if ($product_group === "adult") $product_group = "Erwachsene";







if ($product_cat === 'Geburtstag') $product_group = 'Kinder';
$price_base = get_field("price", $product_id);
$price_per_hour = get_field("baseprice_hour", $product_id);
$price_per_person = get_field("price_person", $product_id);

//
$product_cat_name = get_the_category($product_id)[0]->cat_name;
$product_cat_description = get_field($product_cat, "options")["product_description"];



// Farbe für die Buchung festlegen
$colorParams = [
    'KursKinder' => [
        'colorName' => 'blue',
        'colorHex' => '#3fcad6',
        'colorHexDark' => '#33a2ab',
    ],
    'KursErwachsene' => [
        'colorName' => 'purple',
        'colorHex' => '#4248de',
        'colorHexDark' => '#353ab2',
    ],
    'Workshop' => [
        'colorName' => 'red',
        'colorHex' => '#de332a',
        'colorHexDark' => '#c72e26',
    ],
    'Geburtstag' => [
        'colorName' => 'green',
        'colorHex' => '#55d045',
        'colorHexDark' => '#44ad36',
    ],
    'Kunstevent' => [
        'colorName' => 'pink',
        'colorHex' => '#b23cdf',
        'colorHexDark' => '#9322BE',
    ],
    'Ferienprogramm' => [
        'colorName' => 'yellow',
        'colorHex' => '#d8d12b',
        'colorHexDark' => '#d8d12b',
    ],
];
foreach ($colorParams as $category => $value) {
    if (str_contains($category, $product_cat_name)) {
        if ($product_cat_name === 'Kurs') {
            if (str_contains($category, $product_group)) {
                $color_name = $value['colorName'];
                echo "<style> :root { --product-color: {$value['colorHex']}; --product-color-dark: {$value['colorHexDark']}; } </style>";
            }
        } else {
            $color_name = $value['colorName'];
            echo "<style> :root { --product-color: {$value['colorHex']}; --product-color-dark: {$value['colorHexDark']}; } </style>";
        }
    }
}




//Kurse
$lessons = get_field("lessons", $product_id);
$lessons_count = $lessons["lessons_count"];
$lessons_duration = $lessons["lessons_duration"];


//Workshops
$workshop_duration = get_field("duration", $product_id);
$date_double = false;


//Kunstevent
$duration = get_field("duration", $product_id);
$kunstevent_baseprice = get_field("duration", $product_id);
$preis_stunde["dauer_10"];

$kunstevents_preise = get_field("kunstevents_preise", "options");
$kunstevents_preis_stunde = $kunstevents_preise["preis_stunde"];
$kunstevents_preis_essen = $kunstevents_preise["preis_essen"];
$kunstevents_preis_material = get_field("preis_material", $product_id);
$kunstevents_baseprice = ((intval($kunstevents_preis_stunde["dauer_3"]) * 3.5) + ((intval($kunstevents_preis_essen) + $kunstevents_preis_material) * 3)) / 3;


$product_url = get_permalink($product_id);



$product_category_name = "Kurs im 14-Tage Rhythmus";
?>



<style>
    .header,
    .footer,
    .new--footer,
    .new--footer.footer--desktop,
    .new--footer.footer--mobile {
        display: none !important;
        height: 0 !important;
        padding: 0 !important;
    }

    main {
        padding: 0 !important;
    }

    #sib-conversations {
        display: none;
    }
</style>







<div class="js-value" id="js-productId"><?php echo $product_id; ?></div>
<div class="js-value" id="js-productTitle"><?php echo $product_title; ?></div>
<div class="js-value" id="js-productCategory"><?php echo $product_category; ?></div>
<div class="js-value" id="js-productGroup"><?php echo $product_group; ?></div>
<div class="js-value" id="js-productPrice"><?php echo $product_price; ?></div>








<div class="js__prices js__values" style="display:none;">
    <span id="price__base"><?php if ($product_cat !== "Kunstevent") {
                                echo $price_base;
                            } ?></span>
    <span id="price__hour"><?= $price_per_hour ?></span>
    <span id="price__person"><?= $price_per_person ?></span>
    <span id="duration"><?php if ($product_cat === "Kunstevent") {
                            echo "Dauer wählen...";
                        } else {
                            echo $duration;
                        } ?></span>

    <?php //if( $product_cat === "Kunstevent" ) : 
    ?>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_3"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_4"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_5"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_6"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_7"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_8"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_9"] ?></span>
    <span class="kunstevent_price_hour"><?= $kunstevents_preis_stunde["dauer_10"] ?></span>
    <span id="kunstevent_price_food"><?= $kunstevents_preis_essen ?></span>
    <span id="kunstevent_price_material"><?= $kunstevents_preis_material ?></span>
    <?php //endif; 
    ?>
</div>



<?php //if( is_user_logged_in() ) : 
?>

<div class="book">

    <img class="background_swing" src="<?= get_template_directory_uri(); ?>/assets/img/website/book/book_swing_<?= $color_name ?>.svg" alt="">

    <div class="wrapper">

        <div class="book__header">
            <a class="button--back --color-<?= $color_name ?> quit__button" data-product-link="<?= $product_url ?>">
                <span>Buchung verlassen</span>
            </a>
        </div>

        <div class="book__container">

            <div class="book__half book__half--process">
                <div class="process__nav">
                    <span>Termin</span>
                    <svg width="5.277" height="8.555" viewBox="0 0 5.277 8.555">
                        <path data-name="Pfad 937" d="M-498.582,11194.315a1,1,0,0,1-.707-.293,1,1,0,0,1,0-1.414l2.57-2.57-2.57-2.57a1,1,0,0,1,0-1.414,1,1,0,0,1,1.414,0l3.277,3.277a1,1,0,0,1,0,1.414l-3.277,3.277A1,1,0,0,1-498.582,11194.315Z" transform="translate(499.582 -11185.761)" fill="#bfc6cc" />
                    </svg>
                    <span>Informationen</span>
                    <svg width="5.277" height="8.555" viewBox="0 0 5.277 8.555">
                        <path data-name="Pfad 937" d="M-498.582,11194.315a1,1,0,0,1-.707-.293,1,1,0,0,1,0-1.414l2.57-2.57-2.57-2.57a1,1,0,0,1,0-1.414,1,1,0,0,1,1.414,0l3.277,3.277a1,1,0,0,1,0,1.414l-3.277,3.277A1,1,0,0,1-498.582,11194.315Z" transform="translate(499.582 -11185.761)" fill="#bfc6cc" />
                    </svg>
                    <span class="<?php if ($product_cat !== "Geburtstag") {
                                        echo "--disabled";
                                    } ?>">Extras</span>
                    <svg width="5.277" height="8.555" viewBox="0 0 5.277 8.555">
                        <path data-name="Pfad 937" d="M-498.582,11194.315a1,1,0,0,1-.707-.293,1,1,0,0,1,0-1.414l2.57-2.57-2.57-2.57a1,1,0,0,1,0-1.414,1,1,0,0,1,1.414,0l3.277,3.277a1,1,0,0,1,0,1.414l-3.277,3.277A1,1,0,0,1-498.582,11194.315Z" transform="translate(499.582 -11185.761)" fill="#bfc6cc" />
                    </svg>
                    <span>Zahlung</span>
                    <svg width="5.277" height="8.555" viewBox="0 0 5.277 8.555">
                        <path data-name="Pfad 937" d="M-498.582,11194.315a1,1,0,0,1-.707-.293,1,1,0,0,1,0-1.414l2.57-2.57-2.57-2.57a1,1,0,0,1,0-1.414,1,1,0,0,1,1.414,0l3.277,3.277a1,1,0,0,1,0,1.414l-3.277,3.277A1,1,0,0,1-498.582,11194.315Z" transform="translate(499.582 -11185.761)" fill="#bfc6cc" />
                    </svg>
                    <span>Überprüfung</span>
                </div>

                <div class="process__content">
                    <?php

                    // $sql = "SELECT kurs_tag, kurs_zeit FROM `kurse` WHERE `kurs_name` = :kurs_name AND `kurs_nummer` = :kurs_nummer";
                    // $resultsQuery = $db->query($sql, [
                    // 	'kurs_name' => $_GET["sql_id"],
                    // 	'kurs_nummer' => $_GET["course_num"],
                    // ]);

                    // if ($resultsQuery->count() > 0) {
                    // 	$results = $resultsQuery->results();
                    // 	$has_no_dates = false;
                    // 	foreach ($results as $result) {
                    // 		$course_day = $result["kurs_tag"];
                    // 		$course_time = $result["kurs_zeit"];
                    // 	}
                    // }

                    $step = $_GET["step"];
                    switch ($step):
                        case "0":
                            include("booking-steps/start.php");
                            break;
                        case "1":
                            include("booking-steps/date.php");
                            break;
                        case "2":
                            include("booking-steps/info.php");
                            break;
                        case "3":
                            include("booking-steps/extras.php");
                            break;
                        case "4":
                            include("booking-steps/pay.php");
                            break;
                        case "5":
                            include("booking-steps/proof.php");
                            break;
                    endswitch;
                    ?>
                </div>

                <div class="process__buttons">
                    <?php if ($step !== "1") : ?>
                        <a class="button--back --color-<?= $color_name ?> step__prev">
                            <span>Zurück</span>
                        </a>
                    <?php else : ?>
                        <a class="button--back --color-<?= $color_name ?> quit__button show--mobile" data-product-link="<?= $product_url ?>">
                            <span>Buchung verlassen</span>
                        </a>
                        <div class="show--desktop"></div>
                    <?php endif; ?>

                    <a class="button --color-main step__next">
                        <span>
                            <?php if ($step !== "5") :
                                echo "Nächster Schritt";
                            else :
                                if ($product_cat === "Kurs" || $product_cat === "Workshop" || $product_cat === "Ferienprogramm") :
                                    // echo "Verbindlich Buchen";
                                    echo "Verbindlich Anfragen";
                                else :
                                    echo "Unverbindlich Anfragen";
                                endif;
                            endif; ?>
                        </span>
                    </a>

                </div>
            </div>

            <div class="book__half book__half--info">

                <div class="info__mobile-header show--mobile">Zusammenfassung</div>

                <div class="info__content">
                    <div>
                        <div class="product__title__box">
                            <div>
                                <h6><?= $product_cat_description ?></h6>
                                <h4 id="product__name"><?= $product_title ?> <?php if ($product_cat === "Kurs" || $product_cat === "Workshop") : ?>für <span id="product__group"><?= $product_group ?></span><?php endif; ?><?php if ($product_cat === "Geburtstag") : ?><span style="display:none;" id="product__group">KINDER</span><?php endif; ?></h4>
                            </div>
                            <?= get_the_post_thumbnail($product_id) ?>
                        </div>

                        <div class="info__summary">
                            <h6>Zusammenfassung</h6>

                            <div class="summary__facts">

                                <!-- Kurse -->
                                <?php if ($product_cat === "Kurs") : ?>
                                    <?php
                                    $course_day = "";
                                    $course_time = "";
                                    $sql_id = get_field("sql_id");
                                    $servername = "db5001988950.hosting-data.io";
                                    $username = "dbu782740";
                                    $password = "P6kgZoW8cJckujXLQqKY";
                                    $dbname = "dbs1623575";
                                    $mysql = new mysqli($servername, $username, $password, $dbname);
                                    $sql = "SELECT kurs_tag, kurs_zeit FROM kurse WHERE kurs_name = '" . $_GET["sql_id"] . "' AND kurs_nummer = '" . $_GET["course_num"] . "'";
                                    $result = $mysql->query($sql);
                                    if ($result->num_rows > 0) {
                                        $has_no_dates = false;
                                        while ($row = $result->fetch_assoc()) {
                                            $course_day = $row["kurs_tag"];
                                            $course_time = $row["kurs_zeit"];
                                        }
                                    }
                                    ?>
                                    <div><span>Anzahl der Sitzungen</span><span id="course__session__count"><?= $lessons_count ?> Sitzungen</span></div>
                                    <div><span>Dauer einer Sitzung</span><span id="course__session__duration"><?= $lessons_duration ?> Stunden</span></div>
                                    <div><span>Uhrzeit</span><span id="course__time"><?= $course_time ?></span></div>
                                    <div><span>Wochentag</span><span id="course__day"><?= $course_day ?></span></div>
                                <?php endif; ?>

                                <!-- Workshops -->
                                <?php if ($product_cat === "Workshop"  || $product_cat === "Ferienprogramm") : ?>
                                    <div class="summary__duration"><span>Dauer</span><span class="value"><?= $workshop_duration ?> Stunden</span></div>
                                <?php endif; ?>

                                <!-- Geburtstage -->
                                <?php if ($product_cat === "Geburtstag") : ?>
                                    <div class="summary__duration"><span>Dauer</span><span class="value"><?= $workshop_duration ?> Stunden</span></div>
                                <?php endif; ?>

                                <!-- Geburtstage -->
                                <?php if ($product_cat === "Kunstevent") : ?>
                                    <div class="summary__duration"><span>Dauer</span><span class="value"><?= $duration ?> Stunden</span></div>
                                <?php endif; ?>

                            </div>


                            <div class="summary__facts summary__dates">

                                <!-- Kurse -->
                                <?php if ($product_cat === "Kurs") : ?>
                                    <div><span>Starttermin</span><span id="summary__date">wählen...</span></div>
                                <?php endif; ?>

                                <!-- Workshops -->
                                <?php if ($product_cat === "Workshop" || $product_cat === "Ferienprogramm") : ?>
                                    <?php if ($_SESSION['double_date'] === "true") : ?>
                                        <div><span>Termin 1</span><span id="summary__date">wählen...</span></div>
                                        <div><span>Termin 2</span><span id="summary__date2">wählen...</span></div>
                                    <?php else : ?>
                                        <div><span>Termin</span><span id="summary__date">wählen...</span></div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- Geburtstage -->
                                <?php if ($product_cat === "Geburtstag") : ?>
                                    <div><span>Wunschtermin</span><span id="summary__date">wählen...</span></div>
                                <?php endif; ?>

                                <!-- Kunstevents -->
                                <?php if ($product_cat === "Kunstevent") : ?>
                                    <div><span>Wunschtermin</span><span id="summary__date">wählen...</span></div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="info__payment">
                        <h6>Preisübersicht</h6>

                        <div class="summary__facts info__table">

                            <?php if ($product_cat === "Kurs" || $product_cat === "Workshop") : ?>
                                <div class="info__table__row info__table__row--kurs-total">
                                    <span>Gesamtpreis</span>
                                    <span class="value"><?= $price_base ?>€</span>
                                </div>
                            <?php endif; ?>

                            <?php if ($product_cat === "Geburtstag" || $product_cat === "Kunstevent") : ?>
                                <div class="info__table__row info__table__row--kunstevent-person-count">
                                    <span>
                                        Anzahl der Teilnehmer
                                    </span>
                                    <span class="value">Teilnehmerzahl wählen...</span>
                                </div>
                            <?php endif; ?>

                            <?php if ($product_cat === "Geburtstag") : ?>
                                <div class="info__table__row info__table__row--geburtstag-price-base">
                                    <span>Grundpreis
                                        <div class="tooltip">
                                            <img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_mini_info_<?= $color_name ?>" alt="Info">
                                            <span></span>
                                        </div>
                                    </span>
                                    <span class="value" data-value="<?= $price_base ?>"><?= $price_base ?>€</span>
                                </div>

                                <div class="info__table__row info__table__row--geburtstag-price-person">
                                    <span>
                                        Materialkosten
                                        <div class="tooltip">
                                            <img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_mini_info_<?= $color_name ?>" alt="Info">
                                            <span></span>
                                        </div>
                                    </span>
                                    <span class="value">Teilnehmerzahl wählen...</span>
                                    <p class="material__perperson"><?= $price_per_person ?></p>
                                </div>

                                <div class="info__table__row info__table__row--geburtstag-total info__table__row--total">
                                    <span>Gesamtpreis</span>
                                    <span class="value" id="product__price">ab <?= $price_base ?>€</span>
                                    <p><?= $price_base ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($product_cat === "Kunstevent") : ?>
                                <div class="info__table__row info__table__row--kunstevent-person-price">
                                    <span>
                                        Preis pro Teilnehmer
                                    </span>
                                    <span class="value">Teilnehmerzahl wählen...</span>
                                </div>

                                <div class="info__table__row info__table__row--kunstevent-total info__table__row--total">
                                    <span>
                                        Gesamtpreis
                                        <div class="tooltip">
                                            <img src="<?= get_template_directory_uri() ?>/assets/img/icons/icon_mini_info_<?= $color_name ?>" alt="Info">
                                            <span></span>
                                        </div>
                                    </span>
                                    <span class="value">Konfiguration wählen...</span>
                                    <p class="material__perperson"><?= $price_per_person ?></p>
                                </div>
                            <?php endif; ?>

                            <template id="price__extra">
                                <div class="price__extra --extra">
                                    <span class="title">---</span>
                                    <span class="value">---</span>
                                </div>
                            </template>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<?php //else: 
?>

<!-- <h1>Buchung aktuell nicht verfügbar.</h1> -->

<?php //endif; 
?>



<?php get_footer(); ?>
<?php
/*------------------------------------*/
/* AJAX */
/*------------------------------------*/

// Add ajaxurl to frontend
function myplugin_ajaxurl()
{
    echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    </script>';
}

function date_overview_get_product_dates()
{

    $url = BOOK_URL . "/api/wordpress/dates";
    $response = file_get_contents($url);
    if ($response === false) return [];
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) return [];
    $apiDates = $data;

    /* ------------------------------------ */
    /* Holiday Workshops
    /* ------------------------------------ */

    // Query dates
    $today = date('Y-m-d'); // Heutiges Datum im Format JJJJ-MM-TT

    $holidayWorkshopDateIds = get_posts(array(
        'post_type' => 'h_workshop_date',
        'posts_per_page' => -1,
        'fields' => 'ids',

        // Alle Einträge ab heute erhalten
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'date_1_date', // Name des ACF-Felds
                'value'   => $today, // Format: JJJJ-MM-TT
                'compare' => '>=', // Abgleich auf einen Wert ab heute
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'date_2_date', // Name des ACF-Felds
                'value'   => $today, // Format: JJJJ-MM-TT
                'compare' => '>=', // Abgleich auf einen Wert ab heute
                'type'    => 'DATE',
            ),
        ),
    ));

    // Get data of dates
    $holidayWorkshopDates = [];
    foreach ($holidayWorkshopDateIds as $dateId) {
        $dateField = get_field('date_1', $dateId);
        $date = new DateTime($dateField['date']);
        $date->setTimezone(new DateTimeZone('Europe/Berlin'));
        $date = $date->format('Y-m-d'); // convert into string of format Y-m-d

        // get all workshops of this date
        $workshops = get_field('holiday_workshop', $dateId);

        foreach ($workshops as $workshopId) {
            $holidayWorkshopDates[] = array(
                'date' => $date,
                'product' => array(
                    'ID' => $workshopId,
                    "url" => get_permalink($workshopId),
                    'starttime' =>  $dateField['starttime'],
                    'endtime' =>  $dateField['endtime'],
                    'title' => get_the_title($workshopId),
                    'category' => get_post_type($workshopId),
                    'group' => get_field('group', $workshopId)["value"],
                    'bookingUrl' => get_field("booking_link", $dateId) ?? get_field("holiday_workshops_booking_link_fallback", "holiday_workshop_options"),
                    'thumbnail' => get_the_post_thumbnail_url($workshopId, 'thumbnail')
                )
            );
        }
    }

    // Merge all dates
    $dates = array_merge($apiDates, $holidayWorkshopDates);

    // Sort dates by date
    usort($dates, function ($a, $b) {
        return $a['date'] <=> $b['date'];
    });

    // // Sort products by starttime
    // // go through $calenderGrid and when products is given sort the items by starttime
    // foreach ($dates as $key => $day) {
    //     if (isset($day['products']) && count($day['products']) > 1) {
    //         $products = $day['products'];
    //         usort($products, function ($a, $b) {
    //             $timeA = new DateTime($a['starttime']);
    //             $timeB = new DateTime($b['starttime']);
    //             // return $timeA <=> $timeB;
    //             return $timeB <=> $timeA;
    //         });
    //         $calenderGrid[$key]['products'] = $products;
    //     }
    // }

    wp_send_json_success($dates);
}

/*------------------------------------*/
/* Hooks */
/*------------------------------------*/
add_action('wp_head', 'myplugin_ajaxurl');

add_action('wp_ajax_date_overview_get_product_dates', 'date_overview_get_product_dates');
add_action('wp_ajax_nopriv_date_overview_get_product_dates', 'date_overview_get_product_dates');

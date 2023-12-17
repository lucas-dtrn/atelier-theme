<?php
/* ------------------------------------*\
/* Ajax
\* ------------------------------------*/

// Add ajaxurl to frontend
function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

// Get the calendar grid for the given month and year
function get_date_overview_product_dates() {
    $productId = $_POST['productId'];

    // fetch product from wordpress api
    $product = wp_remote_get('https://dev.atelier-delatron.de/wp-json/wp/v2/kunstangebot/' . $productId);
    $product = json_decode($product['body'], true);

    if ($product['post_type'] === 'course') {
        $courseTimes = $product['times'];
    }

    wp_send_json_success($product);

    // $exampleCourse = array(
    //     'product' => array(
    //         'ID' => 1,
    //         'title' => 'Beispielkurs',
    //         'category' => 'course',
    //         'group' => array(
    //             'label' => 'Kinder',
    //             'value' => 'child'
    //         ),
    //         'times' => array(
    //             array(
    //                 'weekday' => 'Montag',
    //                 'starttime' => '16:00',
    //                 'endtime' => '17:00',
    //                 'dates' => array(
    //                     '2021-10-01',
    //                     '2021-10-08',
    //                     '2021-10-15',
    //                     '2021-10-22',
    //                     '2021-10-29',
    //                 )
    //             ),
    //             array(
    //                 'weekday' => 'Dienstag',
    //                 'starttime' => '16:00',
    //                 'endtime' => '17:00',
    //                 'dates' => array(
    //                     '2021-10-02',
    //                     '2021-10-09',
    //                     '2021-10-16',
    //                     '2021-10-23',
    //                     '2021-10-30',
    //                 )
    //             ),
    //             array(
    //                 'weekday' => 'Mittwoch',
    //                 'starttime' => '16:00',
    //                 'endtime' => '17:00',
    //                 'dates' => array(
    //                     '2021-10-03',
    //                     '2021-10-10',
    //                     '2021-10-17',
    //                     '2021-10-24',
    //                     '2021-10-31',
    //                 )
    //             ),
    //         )
    //     )
    // );
}
add_action('wp_ajax_get_date_overview_product_dates', 'get_date_overview_product_dates');
add_action('wp_ajax_nopriv_get_date_overview_product_dates', 'get_date_overview_product_dates');

// Get the calendar grid for the given month and year
function render_date_overview_calender_items() {
    $year = $_POST['year'];
    $month = $_POST['month'];

    $calendarGrid = getCalendarGrid($year, $month);

    $content = getDateOverviewCalendarDays($calendarGrid, $year, $month);

    echo $content;
}

add_action('wp_ajax_render_date_overview_calender_items', 'render_date_overview_calender_items');
add_action('wp_ajax_nopriv_render_date_overview_calender_items', 'render_date_overview_calender_items');

// Get the calendar grid for the given month and year
function render_date_overview_calender_items_2() {
    $year = $_POST['year'];
    $month = $_POST['month'];

    $calendarGrid = getCalendarGrid($year, $month);

    $content = getDateOverviewDaysList($calendarGrid, $year, $month);

    echo $content;
}

add_action('wp_ajax_render_date_overview_calender_items_2', 'render_date_overview_calender_items_2');
add_action('wp_ajax_nopriv_render_date_overview_calender_items_2', 'render_date_overview_calender_items_2');


function date_overview_get_product_dates() {
    $productId = $_POST['productId'];
    $year = $_POST['year'];
    $month = $_POST['month'];

    $yearEnd = $year + 1;

    /* ------------------------------------ */
    /* Courses
    /* ------------------------------------ */

    // Query dates
    $courseDateIds = get_posts(array(
        'post_type' => 'course_date',
        'posts_per_page' => -1,
        'fields' => 'ids',

        // Get all dates of current month
        'meta_query'     => array(
            array(
                'key'     => 'date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $yearEnd . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
        ),
    ));

    // Get data of dates
    $courseDates = [];
    foreach ($courseDateIds as $dateId) {
        $date = get_field('date', $dateId);
        $date = new DateTime($date);
        $date->setTimezone(new DateTimeZone('Europe/Berlin'));
        $date = $date->format('Y-m-d'); // convert into string of format Y-m-d

        // get all courses of this date
        $courseTimes = get_field('course_time', $dateId);

        foreach ($courseTimes as $timeId) {
            $course = get_field('course', 'course_time_' . $timeId)[0];
            $courseDates[] = array(
                'date' => $date,
                'product' => array(
                    'ID' => $course->ID,
                    'starttime' =>  get_field('starttime', 'course_time_' . $timeId),
                    'endtime' =>  get_field('endtime', 'course_time_' . $timeId),
                    'title' => $course->post_title,
                    'category' => $course->post_type . '-' . get_field('group', $course->ID)['value'],
                    'group' => get_field('group', $course->ID),
                    'courseTimeId' => $timeId,
                    'weekday' => get_field('weekday', 'course_time_' . $timeId),
                    'bookingUrl' => BOOK_URL . '/?productId=' . $course->ID . '&courseTime=' . $timeId . '&startDate=' . $dateId,
                    'thumbnail' => get_the_post_thumbnail_url($course->ID, 'thumbnail')
                )
            );
        }
    }

    /* ------------------------------------ */
    /* Workshops
    /* ------------------------------------ */

    // TODO: Make shure to correctly display workshops with multiple dates

    // Query dates
    $workshopDateIds = get_posts(array(
        'post_type' => 'workshop_date',
        'posts_per_page' => -1,
        'fields' => 'ids',

        // Get all items with date in current month
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'date_1_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $yearEnd . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'date_2_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $yearEnd . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
        ),
    ));

    // Get data of dates
    $workshopDates = [];
    foreach ($workshopDateIds as $dateId) {
        $dateField = get_field('date_1', $dateId);
        $date = new DateTime($dateField['date']);
        $date->setTimezone(new DateTimeZone('Europe/Berlin'));
        $date = $date->format('Y-m-d'); // convert into string of format Y-m-d

        // get all workshops of this date
        $workshops = get_field('workshop', $dateId);

        foreach ($workshops as $workshopId) {
            $workshopDates[] = array(
                'date' => $date,
                'product' => array(
                    'ID' => $workshopId,
                    'starttime' =>  $dateField['starttime'],
                    'endtime' =>  $dateField['endtime'],
                    'title' => get_the_title($workshopId),
                    'category' => get_post_type($workshopId),
                    'group' => get_field('group', $workshopId),
                    'bookingUrl' => BOOK_URL . '/?productId=' . $workshopId . '&workshopDate=' . $dateId,
                    'thumbnail' => get_the_post_thumbnail_url($course->ID, 'thumbnail')
                )
            );
        }
    }

    /* ------------------------------------ */
    /* Holiday Workshops
    /* ------------------------------------ */

    // TODO: Make shure to correctly display workshops with multiple dates

    // Query dates
    $holidayWorkshopDateIds = get_posts(array(
        'post_type' => 'h_workshop_date',
        'posts_per_page' => -1,
        'fields' => 'ids',

        // Get all items with date in current month
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'date_1_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $yearEnd . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'date_2_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $yearEnd . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
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
        $workshops = get_field('workshop', $dateId);

        foreach ($workshops as $workshopId) {
            $holidayWorkshopDates[] = array(
                'date' => $date,
                'product' => array(
                    'ID' => $workshopId,
                    'starttime' =>  $dateField['starttime'],
                    'endtime' =>  $dateField['endtime'],
                    'title' => get_the_title($workshopId),
                    'category' => get_post_type($workshopId),
                    'group' => get_field('group', $workshopId),
                    'bookingUrl' => BOOK_URL . '/?productId=' . $workshopId . '&workshopDate=' . $dateId,
                    'thumbnail' => get_the_post_thumbnail_url($course->ID, 'thumbnail')
                )
            );
        }
    }

    // Merge all dates
    $dates = array_merge($courseDates, $workshopDates, $holidayWorkshopDates);

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

add_action('wp_ajax_date_overview_get_product_dates', 'date_overview_get_product_dates');
add_action('wp_ajax_nopriv_date_overview_get_product_dates', 'date_overview_get_product_dates');

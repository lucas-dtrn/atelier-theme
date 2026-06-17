<?php
function getCalendarGrid($year, $month) {
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
                'value'   => array($year . "-" . $month . "-01", $year . "-" . $month . "-31"), // Format: JJJJ-MM-TT
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
        $date->format('Y-m-d');

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
                    'group' => get_field('group', $course->ID)
                )
            );
        }
    }

    /* ------------------------------------ */
    /* Workshops
    /* ------------------------------------ */

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
                'value'   => array($year . "-" . $month . "-01", $year . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'date_2_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $year . "-" . $month . "-31"), // Format: JJJJ-MM-TT
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
        $date->format('Y-m-d');

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
                    'group' => get_field('group', $workshopId)
                )
            );
        }
    }

    /* ------------------------------------ */
    /* Holiday Workshops
    /* ------------------------------------ */

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
                'value'   => array($year . "-" . $month . "-01", $year . "-" . $month . "-31"), // Format: JJJJ-MM-TT
                'compare' => 'BETWEEN', // Abgleich auf einen Wert zwischen dem 1. und letzten Tag des Monats
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'date_2_date', // Name des ACF-Felds
                'value'   => array($year . "-" . $month . "-01", $year . "-" . $month . "-31"), // Format: JJJJ-MM-TT
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
        $date->format('Y-m-d');

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
                    'group' => get_field('group', $workshopId)
                )
            );
        }
    }

    /* ------------------------------------ */
    /* Create Calendar Grid data
    /* ------------------------------------ */

    $calenderGrid = generateCalendarGrid($year, $month);
    $dates = array_merge($courseDates, $workshopDates, $holidayWorkshopDates);

    // map $dates to $calenderGrid
    foreach ($dates as $date) {
        $date['date'] = $date['date']->format('Y-m-d');

        foreach ($calenderGrid as $key => $day) {
            if ($date['date'] === $day['date']) {
                $calenderGrid[$key]['products'][] = $date['product'];
            }
        }
    }

    // Sort products by starttime
    // go through $calenderGrid and when products is given sort the items by starttime
    foreach ($calenderGrid as $key => $day) {
        if (isset($day['products']) && count($day['products']) > 1) {
            $products = $day['products'];
            usort($products, function ($a, $b) {
                $timeA = new DateTime($a['starttime']);
                $timeB = new DateTime($b['starttime']);
                // return $timeA <=> $timeB;
                return $timeB <=> $timeA;
            });
            $calenderGrid[$key]['products'] = $products;
        }
    }

    return $calenderGrid;
}

function generateCalendarGrid($year = null, $month = null) {
    // Falls Jahr oder Monat nicht angegeben sind, verwende das aktuelle Datum
    if ($year === null || $month === null) {
        $today = new DateTime();
        $year = $today->format('Y');
        $month = $today->format('n');
    }

    // Erster Tag des angegebenen Monats und Jahres
    $firstDayOfMonth = new DateTime("$year-$month-01");

    // Erster Tag der Woche (z.B. Montag)
    $firstDayOfWeek = 1; // Montag (0 = Sonntag, 1 = Montag, usw.)

    // Festlegen des Startdatums unter Berücksichtigung des ersten Wochentags
    $startDate = clone $firstDayOfMonth;
    $startDate->modify('last monday');

    // Erzeuge das Grid
    $calendarGrid = array();

    while ($startDate->format('Y-m-d') <= $firstDayOfMonth->format('Y-m-t')) {
        $calendarGrid[] = [
            // 'date' => $startDate,
            'date' => $startDate->format('Y-m-d'),
            'day' => $startDate->format('d'),
            'month' => $startDate->format('m'),
            'currentMonth' => $startDate->format('m') == $month
        ];
        $startDate->modify('+1 day');
    }

    // Füge die ersten Tage des nächste Monats hinzu, um das Grid zu vervollständigen
    $endDate = clone $startDate;
    $endDate->modify('next monday');

    while ($startDate->format('Y-m-d') < $endDate->format('Y-m-d')) {
        $calendarGrid[] = [
            'date' => $startDate->format('Y-m-d'),
            'day' => $startDate->format('d'),
            'month' => $startDate->format('m'),
            'currentMonth' => $startDate->format('m') == $month
        ];
        $startDate->modify('+1 day');
    }
    return $calendarGrid;
}

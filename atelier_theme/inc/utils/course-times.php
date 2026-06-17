<?php

/**
 *
 * Numerates every course time that is not the only one on that weekday
 *
 * @param    array  $courseTimes courseTimes object 
 * @return   array  $courseTimes courseTimes object with numerated weekdays
 *
 */
function numerateWeekdays($courseTimes)
{
    // Variables
    $numberedWeekdays = [];
    $numeration = 0;

    // Loop through every courseTime
    $courseTimes = array_map(function ($courseTime) use ($courseTimes, &$numberedWeekdays, &$numeration) {

        $weekday = $courseTime['weekday']['value'];
        $weekdayCount = count(array_filter($courseTimes, function ($courseTime) use ($weekday) {
            return $courseTime['weekday']['value'] === $weekday;
        }));

        if (!in_array($weekday, $numberedWeekdays)) $numeration = 1;
        else $numeration++;

        if ($weekdayCount > 1) {
            $courseTime['weekday']['label'] .= ' ' . $numeration;
            $numberedWeekdays[] = $courseTime['weekday']['value'];
        }

        return $courseTime;
    }, $courseTimes);

    // Reset variables
    $numeration = null;

    return $courseTimes;
}

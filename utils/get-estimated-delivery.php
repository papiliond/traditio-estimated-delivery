<?php

function get_estimated_delivery()
{
    $deliveryInDays = get_option('estimated_delivery_in_days');
    $holidays = explode("\n", get_option('estimated_delivery_holidays'));

    $now = new DateTime('now');
    $now->setTimeZone(new DateTimeZone('Europe/Budapest')); // Change to london time.

    $deliveryDates = array();
    for ($i = 0; $i < $deliveryInDays; $i++) {
        $date = clone $now;
        date_add($date, date_interval_create_from_date_string($i . ' days'));
        array_push($deliveryDates, $date);
    }

    $daysNeeded = count($deliveryDates);
    foreach ($deliveryDates as $deliveryDate) {
        $daysNeeded += getDaysNeeded($deliveryDate, $holidays);
    }

    return $daysNeeded;
}

function getDaysNeeded($deliveryDate, $holidays)
{
    $newDate = null;

    foreach ($holidays as $holiday) {
        if (trim($holiday) === $deliveryDate->format('m/d/y')) {
            $newDate = clone $deliveryDate;
            date_add($newDate, date_interval_create_from_date_string('1 days'));
        }
    }

    return 1 + ($newDate !== null ? getDate($newDate, $holidays) : 0);
}

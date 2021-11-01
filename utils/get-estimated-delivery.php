<?php

function get_estimated_delivery()
{
    $deliveryInDays = get_option('estimated_delivery_in_days');
    $deadlineTime = get_option('estimated_delivery_deadline_time');
    $holidays = explode("\n", get_option('estimated_delivery_holidays'));

    $startDate = new DateTime('now');
    $startDate->setTimeZone(new DateTimeZone('Europe/Budapest')); // Change to london time.
    $startTime = strtotime($startDate->format('H:m'));

    // Set first day of delivery
    if (getIsHoliday($startDate, $holidays) === false && getIsWeekend($startDate) === false && strtotime($deadlineTime) < $startTime) {
        date_add($startDate, date_interval_create_from_date_string('1 days'));
    }

    // Create Date ovjects for estimated delivery days
    $deliveryDates = array();
    for ($i = 0; $i < $deliveryInDays; $i++) {
        $date = clone $startDate;
        date_add($date, date_interval_create_from_date_string($i . ' days'));
        array_push($deliveryDates, $date);
    }

    // Calculate days needed to deliver depending on weekends and holidays
    $daysNeeded = 0;
    foreach ($deliveryDates as $deliveryDate) {
        $daysNeeded += getDaysNeeded($deliveryDate, $holidays);
    }

    return $daysNeeded;
}

function getDaysNeeded($deliveryDate, $holidays)
{
    $newDate = null;
    if (getIsHoliday($deliveryDate, $holidays) || getIsWeekend($deliveryDate)) {
        $newDate = clone $deliveryDate;
        date_add($newDate, date_interval_create_from_date_string('1 days'));
    }

    return 1 + ($newDate !== null ? getDaysNeeded($newDate, $holidays) : 0);
}

function getIsWeekend($date)
{
    return $date->format('N') >= 6;
}

function getIsHoliday($date, $holidays)
{
    $result = false;
    foreach ($holidays as $holiday) {
        if (trim($holiday) === $date->format('m/d/y')) {
            $result = true;
        }
    }

    return $result;
}

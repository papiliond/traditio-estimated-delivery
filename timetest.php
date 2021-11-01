<?php

$now = new DateTime('now');
$now->setTimeZone(new DateTimeZone('Europe/Budapest')); // Change to london time.

echo strtotime("13:00") > strtotime($now->format('H:m')) ? "GREATER" : "SMALLER";
<?php

$attendees = $_POST["attendees"];
$capacity = $_POST["capacity"];
$price = $_POST["price"];

$total_screens = ceil($attendees / $capacity);
$empty_seats = ($total_screens * $capacity) - $attendees;
$wasted_money = $price * $empty_seats;

echo "Total screens: ". $total_screens. " | Empty Seats: ". $empty_seats. " | Wasted Money: ". $wasted_money. "<br>";


?>
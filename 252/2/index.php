<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendees = isset($_POST["attendees"]) ? (int)$_POST["attendees"] : 0;
    $capacity = isset($_POST["capacity"]) ? (int)$_POST["capacity"] : 0;
    $price = isset($_POST["price"]) ? (float)$_POST["price"] : 0;

    if ($capacity > 0 && $attendees > 0) {
        $total_screens = (int)ceil($attendees / $capacity);
        $empty_seats = ($total_screens * $capacity) - $attendees;
        $wasted_money = $price * $empty_seats;

        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>Total Screens</th><th>Empty Seats</th><th>Wasted Money (BDT)</th></tr>";
        echo "<tr><td>$total_screens</td><td>$empty_seats</td><td>" . number_format($wasted_money, 2) . "</td></tr>";
        echo "</table>";
        echo "<br>Total screens: " . $total_screens . " | Empty Seats: " . $empty_seats . " | Wasted Money: " . $wasted_money . "<br>";
    } else {
        echo "<p style='color:red;'>Please enter valid positive numbers for attendees and capacity.</p>";
    }
} else {
    echo "Please submit the form from <a href='index.html'>index.html</a>.";
}
?>
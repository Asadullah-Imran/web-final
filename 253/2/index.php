<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planning Sales Tracker</title>
</head>
<body>
    <h2>Event Planning Sales Tracker</h2>

    <form method="post" action="">
        <label>Items Sold Per Day:</label>
        <input type="number" name="items_per_day" min="0" required value="<?php echo isset($_POST['items_per_day']) ? htmlspecialchars($_POST['items_per_day']) : ''; ?>"><br><br>

        <label>Number of Days:</label>
        <input type="number" name="days" min="1" required value="<?php echo isset($_POST['days']) ? htmlspecialchars($_POST['days']) : ''; ?>"><br><br>

        <label>Target Items:</label>
        <input type="number" name="target" min="0" required value="<?php echo isset($_POST['target']) ? htmlspecialchars($_POST['target']) : ''; ?>"><br><br>

        <button type="submit" name="submit">Check Performance</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $items_per_day = (int)$_POST['items_per_day'];
        $days = (int)$_POST['days'];
        $target = (int)$_POST['target'];

        $total_items = $items_per_day * $days;

        // Classification
        // Excellent: 500 or more
        // Good: 300 or more but less than 500
        // Average: 150 or more but less than 300
        // Poor: less than 150
        if ($total_items >= 500) {
            $performance = "Excellent";
        } elseif ($total_items >= 300) {
            $performance = "Good";
        } elseif ($total_items >= 150) {
            $performance = "Average";
        } else {
            $performance = "Poor";
        }

        // Compare total with target
        if ($total_items === $target) {
            $result = "Target met exactly (0 difference)";
        } elseif ($total_items > $target) {
            $diff = $total_items - $target;
            $result = "Above target by " . $diff . " items";
        } else {
            $diff = $target - $total_items;
            $result = "Below target by " . $diff . " items";
        }

        echo "<br><table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>Items Sold per Day</th><th>Number of Days</th><th>Target Items</th><th>Total Items Sold</th><th>Performance</th><th>Result</th></tr>";
        echo "<tr><td>$items_per_day</td><td>$days</td><td>$target</td><td>$total_items</td><td>$performance</td><td>$result</td></tr>";
        echo "</table>";
    }
    ?>
</body>
</html>

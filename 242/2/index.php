<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hill Trip Average Speed Calculator</title>
</head>
<body>
    <h2>Karim's Hill Trip Average Speed Calculator</h2>

    <form method="post" action="">
        <label>Time Spent Going Uphill (in minutes):</label>
        <input type="number" name="time_uphill" step="any" required value="<?php echo isset($_POST['time_uphill']) ? htmlspecialchars($_POST['time_uphill']) : '18'; ?>">
        <br><br>

        <label>Speed Going Uphill (in km/h):</label>
        <input type="number" name="speed_uphill" step="any" required value="<?php echo isset($_POST['speed_uphill']) ? htmlspecialchars($_POST['speed_uphill']) : '20'; ?>">
        <br><br>

        <label>Speed Going Downhill (in km/h):</label>
        <input type="number" name="speed_downhill" step="any" required value="<?php echo isset($_POST['speed_downhill']) ? htmlspecialchars($_POST['speed_downhill']) : '60'; ?>">
        <br><br>

        <input type="submit" name="submit" value="Calculate Average Speed">
    </form>

    <?php
    /**
     * Calculates the average speed for the whole round trip in km/h.
     *
     * @param float $time_uphill Time spent uphill in minutes
     * @param float $speed_uphill Speed uphill in km/h
     * @param float $speed_downhill Speed downhill in km/h
     * @return int Average speed as a whole number
     */
    function calculate($time_uphill, $speed_uphill, $speed_downhill) {
        // Distance uphill in km = speed * (time in hours)
        $distance_uphill = $speed_uphill * ($time_uphill / 60);

        // Since it is the same hill, distance downhill is equal to distance uphill
        $distance_downhill = $distance_uphill;
        $total_distance = $distance_uphill + $distance_downhill;

        // Time spent downhill in hours = distance / speed
        $time_downhill_hours = $distance_downhill / $speed_downhill;
        $time_uphill_hours = $time_uphill / 60;
        $total_time_hours = $time_uphill_hours + $time_downhill_hours;

        // Average speed = Total Distance / Total Time
        $avg_speed = $total_distance / $total_time_hours;

        return (int)round($avg_speed);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $t = (float)$_POST['time_uphill'];
        $v1 = (float)$_POST['speed_uphill'];
        $v2 = (float)$_POST['speed_downhill'];

        if ($t > 0 && $v1 > 0 && $v2 > 0) {
            $ans = calculate($t, $v1, $v2);
            echo "<h3>Result: " . $ans . " km/h</h3>";
        } else {
            echo "<p style='color:red;'>Please enter positive numbers for all inputs.</p>";
        }
    }

    echo "<hr><h4>Test Cases from Question:</h4>";
    echo "calculate(18, 20, 60) = " . calculate(18, 20, 60) . " km/h (Expected: 30)<br>";
    echo "calculate(30, 8, 24) = " . calculate(30, 8, 24) . " km/h (Expected: 12)<br>";
    ?>
</body>
</html>

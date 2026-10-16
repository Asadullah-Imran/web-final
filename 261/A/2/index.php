<!DOCTYPE html>
<html>

<head>
    <title>Student Academic Tracker</title>
</head>

<body>

    <h2>Student Academic Tracking System</h2>

    <form method="post" action="">
        Credits per Course:
        <input type="number" name="credits" min="0" step="any" required>
        <br><br>

        Courses Completed:
        <input type="number" name="courses" min="0" required>
        <br><br>

        Target Graduation Credits:
        <input type="number" name="target" min="0" step="any" required>
        <br><br>

        <input type="submit" name="submit" value="Calculate">
    </form>

    <?php
if (isset($_POST['submit'])) {

    // Get inputs
    $credits = (float) $_POST['credits'];
    $courses = (int) $_POST['courses'];
    $target = (float) $_POST['target'];

    // Calculate total credits
    $total = $credits * $courses;

    // Classify academic progress
    if ($total >= 120) {
        $progress = "Excellent";
    } elseif ($total >= 90) {
        $progress = "Good";
    } elseif ($total >= 60) {
        $progress = "Average";
    } else {
        $progress = "Poor";
    }

    // Compare total credits with target
    if ($total == $target) {
        $result = "Target met exactly (0 difference)";
    } elseif ($total > $target) {
        $difference = $total - $target;
        $result = "Above target by " . $difference;
    } else {
        $difference = $target - $total;
        $result = "Below target by " . $difference;
    }

    // Display output
    echo "<h3>Academic Report</h3>";
    echo "Total Credits: " . $total . "<br>";
    echo "Progress: " . $progress . "<br>";
    echo "Target Credits: " . $target . "<br>";
    echo "Result: " . $result;
}
?>

</body>

</html>

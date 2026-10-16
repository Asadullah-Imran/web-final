<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks Calculator</title>
</head>
<body>
    <h2>Student CT and Exam Marks Calculator</h2>

    <form method="post" action="">
        <label>CT 1:</label>
        <input type="number" step="any" name="ct1" required value="<?php echo isset($_POST['ct1']) ? htmlspecialchars($_POST['ct1']) : '12'; ?>"><br><br>

        <label>CT 2:</label>
        <input type="number" step="any" name="ct2" required value="<?php echo isset($_POST['ct2']) ? htmlspecialchars($_POST['ct2']) : '15'; ?>"><br><br>

        <label>CT 3:</label>
        <input type="number" step="any" name="ct3" required value="<?php echo isset($_POST['ct3']) ? htmlspecialchars($_POST['ct3']) : '14'; ?>"><br><br>

        <label>Midterm Marks:</label>
        <input type="number" step="any" name="midterm" required value="<?php echo isset($_POST['midterm']) ? htmlspecialchars($_POST['midterm']) : '22'; ?>"><br><br>

        <label>Final Marks:</label>
        <input type="number" step="any" name="final" required value="<?php echo isset($_POST['final']) ? htmlspecialchars($_POST['final']) : '32'; ?>"><br><br>

        <input type="submit" name="submit" value="Calculate Total">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ct1 = (float)$_POST['ct1'];
        $ct2 = (float)$_POST['ct2'];
        $ct3 = (float)$_POST['ct3'];
        $mid = (float)$_POST['midterm'];
        $fin = (float)$_POST['final'];

        // Find the best two CT marks
        $cts = [$ct1, $ct2, $ct3];
        rsort($cts); // Sort descending: [0] and [1] are the highest two
        $best_two_total = $cts[0] + $cts[1];
        $ct_avg = $best_two_total / 2;

        // Note: Demo output in the exam paper shows Total Marks = Best two total (29) + Midterm (22) + Final (32) = 83
        $total_marks = $best_two_total + $mid + $fin;
        $status = ($total_marks > 54) ? "Passed" : "Failed";

        echo "<br><div style='padding:15px; border:1px solid #ccc; width:fit-content; background:#f9f9f9;'>";
        echo "<strong>Best two CT's total:</strong> " . $best_two_total . "<br>";
        echo "<strong>Midterm marks:</strong> " . $mid . "<br>";
        echo "<strong>Final Marks:</strong> " . $fin . "<br><br>";
        echo "<strong>Total Marks = " . $total_marks . "</strong><br>";
        echo "<strong>Status: " . $status . "</strong>";
        echo "</div>";
    }
    ?>
</body>
</html>

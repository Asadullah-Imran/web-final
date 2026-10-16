<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Party Calculator</title>
</head>
<body>
    <h2>Pizza Party Calculator</h2>
    <form method="POST" action="">
        <label>Number of Students:</label>
        <input type="number" name="students" min="1" required value="<?php echo isset($_POST['students']) ? htmlspecialchars($_POST['students']) : ''; ?>">
        <br><br>
        <label>Slices Per Student:</label>
        <input type="number" name="slicesStudent" min="1" required value="<?php echo isset($_POST['slicesStudent']) ? htmlspecialchars($_POST['slicesStudent']) : ''; ?>">
        <br><br>
        <label>Slices Per Pizza:</label>
        <input type="number" name="slicesPizza" min="1" required value="<?php echo isset($_POST['slicesPizza']) ? htmlspecialchars($_POST['slicesPizza']) : ''; ?>">
        <br><br>
        <button type="submit" name="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $students = (int)$_POST["students"];
        $slicesStudent = (int)$_POST["slicesStudent"];
        $slicePizza = (int)$_POST["slicesPizza"];

        if ($slicePizza > 0 && $students > 0 && $slicesStudent > 0) {
            $totalNeeded = $students * $slicesStudent;
            $totalPizza = (int)ceil($totalNeeded / $slicePizza);
            $leftover = ($totalPizza * $slicePizza) - $totalNeeded;
            $wasted = ($leftover * (1050 / $slicePizza));

            echo "<br><table border='1' cellpadding='8' cellspacing='0'>"; 
            echo "<tr><th>Total Pizzas</th><th>Leftover Slices</th><th>Wasted Money (BDT)</th></tr>";
            echo "<tr><td>$totalPizza</td><td>$leftover</td><td>" . number_format($wasted, 2) . "</td></tr>";
            echo "</table>";
        }
    }
    ?>
</body>
</html>

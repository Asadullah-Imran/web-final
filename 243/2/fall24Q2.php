<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Pizza Calculator</h1>
    <form method="POST" action="">
        <label>Number of Students:</label>
        <input type="text" name="students">
        <br><br>
        <label>Slices Per Students:</label>
        <input type="text" name="slicesStudent">
        <br><br>
        <label>Slices Per Pizza:</label>
        <input type="text" name="slicesPizza">
        <br><br>
        <button name="submit">Submit</button>
    </form>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    $students = (int)$_POST["students"];
    $slicesStudent = (int)$_POST["slicesStudent"];
    $slicePizza = (int)$_POST["slicesPizza"];

    $totalNeeded = $students * $slicesStudent;
    $totalPizza = ceil($totalNeeded / $slicePizza);
    $leftover = ($totalPizza * $slicePizza) - $totalNeeded;

    $wasted = (1050 / $slicePizza) * $leftover;

    echo "<table border = '1'>"; 
    echo "<tr><th>Total Pizzas:</th><th>Leftover Slices:</th><th>Wasted Mondey(BDT):</th></tr>";
    echo "<tr><td>$totalPizza</td><td>$leftover</td><td>$wasted</td></tr>";
    echo "</table>";
}
?>

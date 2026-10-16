<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "electricity_bill";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Auto-create database & table if needed
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$table_sql = "CREATE TABLE IF NOT EXISTS bill_info (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    location VARCHAR(100),
    area VARCHAR(100),
    rate_0_75 FLOAT,
    rate_76_200 FLOAT,
    rate_201_above FLOAT
)";
$conn->query($table_sql);

// Seed if empty
$check = $conn->query("SELECT COUNT(*) AS total FROM bill_info");
$row = $check->fetch_assoc();
if ($row['total'] == 0) {
    $insert_sql = "INSERT INTO bill_info (id, location, area, rate_0_75, rate_76_200, rate_201_above) VALUES
    (1, 'Dhaka', 'Urban', 4.19, 5.72, 6.00),
    (2, 'Dhaka', 'Rural', 3.19, 4.72, 5.00),
    (3, 'Chittagong', 'Urban', 3.50, 4.80, 5.23),
    (4, 'Chittagong', 'Rural', 2.50, 3.80, 4.23)";
    $conn->query($insert_sql);
}

$location = $_POST['location'] ?? 'Dhaka';
$area = $_POST['area'] ?? 'Urban';
$unit = isset($_POST['unit']) ? (float)$_POST['unit'] : 0;

// Fetch rate info from database
$stmt = $conn->prepare("SELECT rate_0_75, rate_76_200, rate_201_above FROM bill_info WHERE location = ? AND area = ?");
$stmt->bind_param("ss", $location, $area);
$stmt->execute();
$res = $stmt->get_result();
$rates = $res->fetch_assoc();

if (!$rates) {
    die("Rate info not found for location: $location and area: $area");
}

$rate1 = $rates['rate_0_75'];
$rate2 = $rates['rate_76_200'];
$rate3 = $rates['rate_201_above'];

// Calculate tiered bill
$base_bill = 0;
if ($unit <= 75) {
    $base_bill = $unit * $rate1;
} elseif ($unit <= 200) {
    $base_bill = (75 * $rate1) + (($unit - 75) * $rate2);
} else {
    $base_bill = (75 * $rate1) + (125 * $rate2) + (($unit - 200) * $rate3);
}

// Tax: Dhaka = 20%, Chittagong = 15%
$tax_rate = (strcasecmp($location, 'Dhaka') === 0) ? 0.20 : 0.15;
$tax = $base_bill * $tax_rate;
$total_bill = $base_bill + $tax;

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Result</title>
</head>
<body>
    <div style="width: 380px; margin: 40px auto; font-family: sans-serif; border: 1px solid #ccc; padding: 25px; border-radius: 4px;">
        <h3 style="margin-top: 0; color: #333;">bill.php</h3>
        <p><strong>Your location:</strong> <?php echo htmlspecialchars($location); ?></p>
        <p><strong>Your area:</strong> <?php echo htmlspecialchars($area); ?></p>
        <p><strong>Unit consumed:</strong> <?php echo htmlspecialchars((string)$unit); ?></p>
        <h4 style="margin-bottom: 0; color: #111;">Total bill: <?php echo number_format($total_bill, 2, '.', ''); ?> BDT</h4>
    </div>
</body>
</html>

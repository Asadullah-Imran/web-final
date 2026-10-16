<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "retail_company";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure database and table exist
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$table_sql = "CREATE TABLE IF NOT EXISTS sales (
    sale_id INT PRIMARY KEY,
    product_id INT,
    quantity_sold INT,
    sale_date DATE,
    total_price DECIMAL(10, 2)
)";
$conn->query($table_sql);

// Seed sample data if empty
$check_empty = $conn->query("SELECT COUNT(*) AS total FROM sales");
$row = $check_empty->fetch_assoc();
if ($row['total'] == 0) {
    $insert_sql = "INSERT INTO sales (sale_id, product_id, quantity_sold, sale_date, total_price) VALUES
    (1, 107, 5, '2024-01-01', 2500.00),
    (2, 103, 3, '2024-01-02', 900.00),
    (3, 103, 2, '2024-01-02', 60.00),
    (4, 107, 4, '2024-01-03', 80.00),
    (5, 107, 6, '2024-01-03', 90.00)";
    $conn->query($insert_sql);
}

echo "<h2>Retail Sales Analysis (January 2024)</h2>";

// -------------------------------------------------------------
// Report 1: Total quantity sold and total revenue for each product
// -------------------------------------------------------------
echo "<h3>1. Total Quantity Sold and Total Revenue per Product</h3>";
$sql1 = "SELECT product_id, SUM(quantity_sold) AS total_qty, SUM(total_price) AS total_rev
         FROM sales
         GROUP BY product_id";
$res1 = $conn->query($sql1);

if ($res1 && $res1->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Product ID</th><th>Total Quantity Sold</th><th>Total Revenue (BDT)</th></tr>";
    while ($row = $res1->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . $row['total_qty'] . "</td>";
        echo "<td>" . number_format($row['total_rev'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No sales records found.<br>";
}

echo "<br><hr>";

// -------------------------------------------------------------
// Report 2: Two days in January 2024 with highest total revenue
// -------------------------------------------------------------
echo "<h3>2. Two Days in January 2024 with Highest Total Revenue</h3>";
$sql2 = "SELECT sale_date, SUM(total_price) AS daily_revenue
         FROM sales
         WHERE sale_date BETWEEN '2024-01-01' AND '2024-01-31'
         GROUP BY sale_date
         ORDER BY daily_revenue DESC
         LIMIT 2";
$res2 = $conn->query($sql2);

if ($res2 && $res2->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Sale Date</th><th>Total Daily Revenue (BDT)</th></tr>";
    while ($row = $res2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['sale_date'] . "</td>";
        echo "<td>" . number_format($row['daily_revenue'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.<br>";
}

echo "<br><hr>";

// -------------------------------------------------------------
// Report 3: Average quantity sold per product for products with sales on >= 2 different days
// -------------------------------------------------------------
echo "<h3>3. Average Quantity Sold per Product (Products with Sales on at least 2 Days in Jan 2024)</h3>";
$sql3 = "SELECT product_id, AVG(quantity_sold) AS avg_qty, COUNT(DISTINCT sale_date) AS days_count
         FROM sales
         WHERE sale_date BETWEEN '2024-01-01' AND '2024-01-31'
         GROUP BY product_id
         HAVING COUNT(DISTINCT sale_date) >= 2";
$res3 = $conn->query($sql3);

if ($res3 && $res3->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Product ID</th><th>Average Quantity Sold</th><th>Distinct Sales Days</th></tr>";
    while ($row = $res3->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['product_id'] . "</td>";
        echo "<td>" . number_format($row['avg_qty'], 2) . "</td>";
        echo "<td>" . $row['days_count'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products met the condition of sales on at least 2 different days.<br>";
}

$conn->close();
?>

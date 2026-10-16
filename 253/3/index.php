<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_library";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Auto-create database & table
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$table_sql = "CREATE TABLE IF NOT EXISTS book_loans (
    LoanID INT PRIMARY KEY,
    StudentName VARCHAR(100),
    BookTitle VARCHAR(100),
    DaysOverdue INT,
    PenaltyFee DECIMAL(10, 2),
    Status VARCHAR(50)
)";
$conn->query($table_sql);

// Seed sample data if empty
$check = $conn->query("SELECT COUNT(*) AS total FROM book_loans");
$row = $check->fetch_assoc();
if ($row['total'] == 0) {
    $insert_sql = "INSERT INTO book_loans (LoanID, StudentName, BookTitle, DaysOverdue, PenaltyFee, Status) VALUES
    (101, 'Abdul', 'Data Structures', 0, 0.00, 'Returned'),
    (102, 'Jabbar', 'Operating Systems', 12, 24.00, 'Overdue'),
    (103, 'Barkat', 'Discrete Math', 5, 10.00, 'Overdue'),
    (104, 'Rahim', 'Linear Algebra', 2, 4.00, 'Overdue'),
    (105, 'Karim', 'Data Structures', 15, 30.00, 'Lost'),
    (106, 'Fahim', 'Operating Systems', 0, 0.00, 'Returned')";
    $conn->query($insert_sql);
}

echo "<h2>Fall 2025 - Question 3: Campus Library Book Loans</h2>";

// -------------------------------------------------------------
// Query 1: Total books for each Status having more than 1 entry
// -------------------------------------------------------------
echo "<h3>1. Total Books per Status (Statuses with &gt; 1 entry)</h3>";
$sql1 = "SELECT Status, COUNT(*) AS total_books
         FROM book_loans
         GROUP BY Status
         HAVING COUNT(*) > 1";
$res1 = $conn->query($sql1);

if ($res1 && $res1->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Status</th><th>Total Books</th></tr>";
    while ($row = $res1->fetch_assoc()) {
        echo "<tr><td>" . $row['Status'] . "</td><td>" . $row['total_books'] . "</td></tr>";
    }
    echo "</table>";
}

echo "<br><hr>";

// -------------------------------------------------------------
// Query 2: If Status = 'Overdue' and DaysOverdue < 7, Status = 'Grace Period' and PenaltyFee = 0
// -------------------------------------------------------------
echo "<h3>2. Change Status to 'Grace Period' and PenaltyFee to 0 (Overdue &amp; DaysOverdue &lt; 7)</h3>";
$sql2 = "UPDATE book_loans
         SET Status = 'Grace Period', PenaltyFee = 0.00
         WHERE Status = 'Overdue' AND DaysOverdue < 7";
$conn->query($sql2);
echo "<p style='color:green;'>Updated " . $conn->affected_rows . " record(s) to Grace Period.</p>";

echo "<br><hr>";

// -------------------------------------------------------------
// Query 3: PenaltyFee > 20.00, increase fee by 10%, only if final fee <= 50.00
// -------------------------------------------------------------
echo "<h3>3. Increase PenaltyFee by 10% (Fee &gt; 20.00 and Final Fee &le; 50.00)</h3>";
$sql3 = "UPDATE book_loans
         SET PenaltyFee = PenaltyFee * 1.10
         WHERE PenaltyFee > 20.00 AND (PenaltyFee * 1.10) <= 50.00";
$conn->query($sql3);
echo "<p style='color:green;'>Updated " . $conn->affected_rows . " record(s) with processing charge.</p>";

echo "<br><hr>";

// -------------------------------------------------------------
// Query 4: Each BookTitle and total PenaltyFee collected/owed, sorted highest first
// -------------------------------------------------------------
echo "<h3>4. Total Penalty Fee by BookTitle (Highest First)</h3>";
$sql4 = "SELECT BookTitle, SUM(PenaltyFee) AS total_penalty
         FROM book_loans
         GROUP BY BookTitle
         ORDER BY total_penalty DESC";
$res4 = $conn->query($sql4);

if ($res4 && $res4->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Book Title</th><th>Total Penalty Fee (BDT)</th></tr>";
    while ($row = $res4->fetch_assoc()) {
        echo "<tr><td>" . $row['BookTitle'] . "</td><td>" . number_format($row['total_penalty'], 2) . "</td></tr>";
    }
    echo "</table>";
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uiuweb_final";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database and table if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$table_sql = "CREATE TABLE IF NOT EXISTS student_final (
    StudentID INT PRIMARY KEY,
    StudentName VARCHAR(100),
    CourseID INT,
    CourseTitle VARCHAR(100),
    Grade INT,
    LetterGrade VARCHAR(5)
)";
$conn->query($table_sql);

// Check if data exists
$check = $conn->query("SELECT COUNT(*) AS total FROM student_final");
$row = $check->fetch_assoc();
if ($row['total'] == 0) {
    $insert_sql = "INSERT INTO student_final (StudentID, StudentName, CourseID, CourseTitle, Grade, LetterGrade) VALUES
    (1, 'Karim Uddin', 101, 'Web Programming', 85, 'B'),
    (2, 'Rahim Ahmed', 101, 'Web Programming', 92, 'A'),
    (3, 'Jashim Hossain', 102, 'Project Management', 78, 'C'),
    (4, 'Jasica Ahmed', 101, 'Web Programming', 65, 'D'),
    (5, 'Faria Karim', 102, 'Project Management', 95, 'A'),
    (6, 'Niassoh Dihan', 103, 'System Analysis and Design', 80, 'B')";
    $conn->query($insert_sql);
}

echo "<h2>Fall 2024 - Question 3: Student Course & Grade Analysis</h2>";

// -------------------------------------------------------------
// Query 1: Total number of students who received each letter grade (A, B, C, D)
// -------------------------------------------------------------
echo "<h3>1. Total Students per Letter Grade (Across All Courses)</h3>";
$sql1 = "SELECT LetterGrade, COUNT(*) AS total_students
         FROM student_final
         GROUP BY LetterGrade";
$res1 = $conn->query($sql1);

if ($res1 && $res1->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Letter Grade</th><th>Total Students</th></tr>";
    while ($row = $res1->fetch_assoc()) {
        echo "<tr><td>" . $row['LetterGrade'] . "</td><td>" . $row['total_students'] . "</td></tr>";
    }
    echo "</table>";
}

echo "<br><hr>";

// -------------------------------------------------------------
// Query 2: If grade < 75 and letter grade != 'D', change letter grade to 'C'
// -------------------------------------------------------------
echo "<h3>2. Update Letter Grade to 'C' for Grade &lt; 75 and LetterGrade != 'D'</h3>";
$sql2 = "UPDATE student_final
         SET LetterGrade = 'C'
         WHERE Grade < 75 AND LetterGrade != 'D'";
$conn->query($sql2);
echo "<p style='color:green;'>Updated " . $conn->affected_rows . " record(s).</p>";

echo "<br><hr>";

// -------------------------------------------------------------
// Query 3: If grade > 80, add 5 bonus points, but only if (Grade + 5) <= 90
// -------------------------------------------------------------
echo "<h3>3. Add 5 Bonus Points if Grade &gt; 80 and (Grade + 5) &le; 90</h3>";
$sql3 = "UPDATE student_final
         SET Grade = Grade + 5
         WHERE Grade > 80 AND (Grade + 5) <= 90";
$conn->query($sql3);
echo "<p style='color:green;'>Updated " . $conn->affected_rows . " record(s) with bonus points.</p>";

echo "<br><hr>";

// -------------------------------------------------------------
// Query 4: Course titles and number of students enrolled, sorted most popular first
// -------------------------------------------------------------
echo "<h3>4. Course Popularity (Sorted by Enrolled Students Descending)</h3>";
$sql4 = "SELECT CourseTitle, COUNT(*) AS no_students
         FROM student_final
         GROUP BY CourseTitle
         ORDER BY no_students DESC";
$res4 = $conn->query($sql4);

if ($res4 && $res4->num_rows > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Course Title</th><th>Enrolled Students</th></tr>";
    while ($row = $res4->fetch_assoc()) {
        echo "<tr><td>" . $row['CourseTitle'] . "</td><td>" . $row['no_students'] . "</td></tr>";
    }
    echo "</table>";
}

$conn->close();
?>

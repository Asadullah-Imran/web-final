<?php
$conn = new mysqli("localhost", "root", "", "sundarban");

if(!$conn->connect_error) {
    echo "Connection successful!<br>";
}

// For the 1st query--------->
$sql = "
select CategoryName, sum(Revenue) as total_rev
from sales_data
group by CategoryName
";

$res = $conn->query($sql);

if($res->num_rows > 0) {
    echo "1st query is here.....<br>";

    while($row = $res->fetch_assoc()) {
        echo "Total revenue of ". $row["CategoryName"]. " is " . $row["total_rev"]. "<br>";
    }
}


// For the 2nd query----------->
$sql = "
update sales_data
set CategoryName = 'Low Performing'
where Revenue < 40000
";

$conn->query($sql);


echo "<br><br>";

// For the 3rd query------------->
$sql = "
select ProductName, sum(Revenue) as total_rev
from sales_data
group by ProductName
having total_rev > 70000
";

$res = $conn->query($sql);

if($res && $res->num_rows > 0) {
    echo "3rd query is here.....<br>";

    while($row = $res->fetch_assoc()) {
        $total_with_bonus = $row["total_rev"] * 1.10;
        echo "Total revenue with bonus of " . $row["ProductName"] . " is " . $total_with_bonus . "<br>";
    }
}

$sql ="
update sales_data
set Revenue = Revenue * 1.10
where Revenue > 70000
";

$conn->query($sql);

echo "<br><br>";

// For the 4th query------------->
$sql = "
SELECT 
    s.ProductName, 
    s.CategoryName, 
    s.Revenue,
    (SELECT AVG(Revenue) FROM sales_data WHERE CategoryID = s.CategoryID) AS avg_rev
FROM sales_data s
";

$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    echo "4th query is here.....<br>";

    while ($row = $res->fetch_assoc()) {
        // PHP handles the label condition
        if ($row["Revenue"] > $row["avg_rev"]) {
            $label = "Top Seller";
        } else {
            $label = "Regular Seller";
        }

        echo $row["ProductName"] . " (" . $row["CategoryName"] . ") - " . $label . "<br>";
    }
}

?>
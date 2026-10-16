
<?php
$conn = new mysqli("localhost", "root", "", "tourism", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    //que1
    $sql1 = "SELECT SpotName, Region, Rating
From tourist_spot
WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
ORDER BY Rating DESC";

    $res = $conn->query($sql1);
    while($row = $res->fetch_assoc()){
        echo $row["SpotName"]." " ;
        echo $row["Region"]." ";
        echo $row["Rating"]. "<br>";
    }
    

    //que3
    $sql3 = "SELECT Category, COUNT(SpotID), AVG(Rating), SUM(VisitorsPerYear)
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) >4.4
ORDER BY AVG(Rating) DESC";

    $res = $conn->query($sql3);
    while($row = $res->fetch_assoc()){
        echo $row["Category"]." " ;
        echo $row["COUNT(SpotID)"]." ";
        echo $row["AVG(Rating)"]. " ";
        echo $row["SUM(VisitorsPerYear)"]."<br>";
    }

    //que2
    $sql2 = "UPDATE tourist_spot
SET Rating = Rating+0.2 , EntryFee = EntryFee*1.1
WHERE Rating >= 4.0 AND Rating <=4.5 AND EntryFee>0";

    $res = $conn->query($sql2);
    echo "updated<br><br>";

    //que4
    $sql4 = "SELECT Region, SUM(EntryFee * VisitorsPerYear) AS TotalRevenue
FROM tourist_spot
GROUP BY Region
HAVING TotalRevenue > 1000000
ORDER BY TotalRevenue DESC";

    $res = $conn->query($sql4);
    echo "Query 4 (Regions with Revenue > 1,000,000):<br>";
    while($row = $res->fetch_assoc()){
        echo "Region: " . $row["Region"] . " | Estimated Yearly Revenue: " . number_format($row["TotalRevenue"], 2) . "<br>";
    }

?>
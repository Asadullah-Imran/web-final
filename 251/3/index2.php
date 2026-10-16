<?php

$conn = new mysqli("localhost", "root", "","uiutech");

if(!$conn->connect_error){
    echo "successfull";
}

$sql="SELECT PerformanceRating,
count(*) as total_count

from employee_final

group by PerformanceRating 

";


$result = $conn->query($sql);

if($result->num_rows>0){
    echo " | result is coming .. |";

    while($row= $result->fetch_assoc()){

        echo "result is -> ";

        echo $row["total_count"];
    }
}


echo "<br>";


$sql="
update employee_final 
set PerformanceRating = 'F'
where salary < 40000 and PerformanceRating != 'D'
";




$result = $conn->query($sql);






$sql="
update employee_final 
set Salary = Salary + 5000
where Salary >50000 and (Salary + 5000)<= 60000
";




$result = $conn->query($sql);




$sql="SELECT DepartmentName, count(*) as no_emp

from employee_final

group by DepartmentName
order by no_emp desc
";


$result = $conn->query($sql);

if($result->num_rows>0){
    echo " | 4th result is coming .. |";

    while($row= $result->fetch_assoc()){

        echo "result is -> ";

        echo " DepartmentName is -> " . $row["DepartmentName"] . " | No of Employee-> ". $row["no_emp"] . " |";
    }
}


echo "<br>";




?>
<?php

$con= new mysqli("localhost","root","","uiu_bookshop");

if(!$con->connect_error){
    echo "successfully connected to database <br>";
}


$sql="
select BookTitle 
from book_info
where category = 'Programming'
order by Price desc

";

$result=$con->query($sql);


while($row= $result->fetch_assoc()){
    echo $row['BookTitle']."<br>";
}



$sql="
select BookTitle ,  Author,  Price
from book_info
where category = 'Programming' and Price > 400


";

$result=$con->query($sql);


while($row= $result->fetch_assoc()){

    echo $row['BookTitle']." | ". $row['Author']." | ". $row['Price']. "<br>";
}





$sql="
select Category , count(*) as no_book
from book_info
group by Category


";

$result=$con->query($sql);


while($row= $result->fetch_assoc()){

    echo "category of - ". $row['Category']." | no of books -> ". $row['no_book']. "<br>";
}




$sql="
select Price , Stock 
from book_info




";

$result=$con->query($sql);

$total_net_worth=0;


while($row= $result->fetch_assoc()){

  
    $total_net_worth+= $row['Price']*$row['Stock'];
}

echo "total net worht -> ". $total_net_worth;




$sql="

SELECT SUM(Price * Stock) AS Total_Net_Worth
FROM book_info;





";

$result=$con->query($sql);


if ($result) {
    $row = $result->fetch_assoc();

    echo "Result is -----> " . $row['Total_Net_Worth'];
} else {
    echo "Error: " . $con->error;
}




$sql="
update book_info
set price = price * .9
where Category = 'Language'
";

$result=$con->query($sql);

$sql="

SELECT BookTitle , Price
FROM book_info

";

$result=$con->query($sql);
echo "<br>";

while($row= $result->fetch_assoc()){

    echo "booktitle   - ". $row['BookTitle']." | Price -> ". $row['Price']. "<br>";
}

?>
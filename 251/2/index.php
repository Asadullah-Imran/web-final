<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="post">


        <input type="number"  name="attendence">
        <input type="number" name="cost" >
        <input type="number" name="capacity">

        <button name="submit">
            check
        </button>



    


    </form>


    <?php

    $att= $_POST['attendence'];
    $cost= $_POST['cost'];
    $capacity= $_POST['capacity'];

    $total_venue= ceil($att/$capacity);

    $empty_seat= ($total_venue * $capacity)- $att;

    $wasted_money = $empty_seat * $cost;

    echo "total Venue ". $total_venue. " | Empty Seat ". $empty_seat . " | wasted money ". $wasted_money;



    ?>
    
</body>
</html>
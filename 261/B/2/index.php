<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">

        <input type="number" placeholder="distance" name="distance">
        <input type="number" placeholder="energy" name="energy">
        <input type="number" placeholder="capacity" name="capacity">

        <button name="Calculate" type="submit">Calculate</button>

    </form>


    <?php
    $distace= $_POST['distance'];
    $energy= $_POST['energy'];
    $capacity= $_POST['capacity'];
    
    
    $total_energy= $distace * $energy;


    $battery_module_needed= ceil($total_energy/$capacity);

    $unused_energy = ($battery_module_needed*  $capacity) - $total_energy;

    $parcentage= ($unused_energy/$total_energy)*100;
    if($parcentage<=10){
        $status = "Efficient";
    }else if ($parcentage>10 && $parcentage<=25){
        $status = "Acceptable";
    }else{
        $status = "Wasteful";
    }

    echo "Total Energy Required = ".$total_energy ."| Battery Modules = ". $battery_module_needed." | Unused Energy = ".$unused_energy." | Status = ".$status;

    ?>

</body>
</html>

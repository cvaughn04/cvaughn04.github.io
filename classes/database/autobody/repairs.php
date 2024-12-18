<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.html">Return to previous page</a>
<br>
    <h1>Listing of the Repairs</h1>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $repairs = mysqli_query($db_Connection, "SELECT * FROM Repair") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($repairs);

    echo "<table border='1'";
    echo "<tr>
          <th>repair_ID</th>
          <th>repair_description</th>
          <th>time_required</th>
          <th>cost</th>
          </tr>";

    while($row = mysqli_fetch_array($repairs)) {
        echo "<tr>";
        echo "<td>".$row["repair_ID"]."</td>";
        echo "<td>".$row["repair_description"]."</td>";
        echo "<td>".$row["time_required"]."</td>";
        echo "<td>".$row["cost"]."</td>";

    }
    
    mysqli_close($db_Connection);
    echo "<img src='repairProcedure.png' alt='' style='width:600px'></img>"; 
    ?>


</body>
</html>
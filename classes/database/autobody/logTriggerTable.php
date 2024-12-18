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
    <h1>Log_New_Job Trigger Table</h1>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $customers = mysqli_query($db_Connection, "SELECT * FROM Log_New_Job") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);

    echo "<table border='1'";
    echo "<tr>
          <th>Log_ID</th>
          <th>repair_ID</th>
          <th>customer_ID</th>
          <th>car_ID</th>
          <th>Action</th>
          <th>date</th>
          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["Log_ID"]."</td>";
        echo "<td>".$row["repair_ID"]."</td>";
        echo "<td>".$row["customer_ID"]."</td>";
        echo "<td>".$row["car_ID"]."</td>";
        echo "<td>".$row["Action"]."</td>";
        echo "<td>".$row["date"]."</td>";

    }
    mysqli_close($db_Connection);
    echo "<img src='jobTrigger.png' alt='' style='width:400px'></img>"; 

    ?>

</body>
</html>
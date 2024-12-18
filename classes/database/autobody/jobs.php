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
    <h1>Listing of the Cars</h1>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $customers = mysqli_query($db_Connection, "SELECT * FROM Job") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);

    echo "<table border='1'";
    echo "<tr>
          <th>job_ID</th>
          <th>car_ID</th>
          <th>mechanic_ID</th>
          <th>estimate_ID</th>
          <th>job_date</th>
          <th>date_completed</th>
          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["job_ID"]."</td>";
        echo "<td>".$row["car_ID"]."</td>";
        echo "<td>".$row["mechanic_ID"]."</td>";
        echo "<td>".$row["estimate_ID"]."</td>";
        echo "<td>".$row["job_date"]."</td>";
        echo "<td>".$row["date_completed"]."</td>";

    }
    mysqli_close($db_Connection);
    ?>

</body>
</html>
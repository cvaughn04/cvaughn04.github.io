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
    <h1>Listing of the Customers</h1>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $customers = mysqli_query($db_Connection, "SELECT * FROM Customer") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);

    echo "<table border='1'";
    echo "<tr>
          <th>customer_ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Address</th>
          <th>Phone</th>
          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["customer_ID"]."</td>";
        echo "<td>".$row["lName"]."</td>";
        echo "<td>".$row["fName"]."</td>";
        echo "<td>".$row["addr"]."</td>";
        echo "<td>".$row["phone"]."</td>";

    }
    mysqli_close($db_Connection);
    ?>

</body>
</html>
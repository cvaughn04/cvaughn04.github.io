<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> da customers</h1>

    <?php
    $db_location="localhost";
    $db_username="vau48469";
    $db_password="vau48469";
    $db_database="vau48469";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $customers = mysqli_query($db_Connection, "SELECT * FROM customers") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);
    echo $numRecords." number of workers<br><br>";

    echo "<table border='1' style='border-collapse: collapse'";
    echo "<tr>
          <th>cid</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Address</th>
          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["cid"]."</td>";
        echo "<td>".$row["lastName"]."</td>";
        echo "<td>".$row["firstName"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["address"]."</td>";

    }



    mysqli_close($db_Connection);
    ?>

<a href="index.html">go back</a>

</body>
</html>
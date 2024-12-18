<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>The workers for the Workers-Projects Database</h1>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $workers = mysqli_query($db_Connection, "SELECT * FROM Worker") or die ("The query didnt ork");

    $numRecords = mysqli_num_rows($workers);
    echo $numRecords." number of workers<br><br>";

    echo "<table border='1'";
    echo "<tr>
          <th>empID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Date Hired</th>
          <th>Birthdate</th>
          <th>Salary</th>
          <th>Departnment Name</th>
          </tr>";

    while($row = mysqli_fetch_array($workers)) {
        echo "<tr>";
        echo "<td>".$row["empId"]."</td>";
        echo "<td>".$row["lastName"]."</td>";
        echo "<td>".$row["firstName"]."</td>";
        echo "<td>".$row["hireDate"]."</td>";
        echo "<td>".$row["birthDate"]."</td>";
        echo "<td>".$row["salary"]."</td>";
        echo "<td>".$row["deptName"]."</td>";

    }



    mysqli_close($db_Connection);
    ?>

<a href="index.html">go back</a>

</body>
</html>
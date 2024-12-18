<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Simple PHP Web page</h1>

    <?php
    echo "<h3>It's ".date("l, F j Y")."<br>";
    echo "It's ".date("g:ia")."</h3>";

    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $students = mysqli_query($db_Connection, "SELECT * FROM Student") or die ("The query didnt ork");

    $numRecords = mysqli_num_rows($students);
    echo $numRecords." number of students<br><br>";

    echo "<table border='1'";
    echo "<tr>
          <th>ID</th>
          <th>Last Name</th>
          <th>First Name<s/th>
          <th>Major</th>
          <th>Credits</th>
          </tr>";

    while($row = mysqli_fetch_array($students)) {
        echo "<tr>";
        echo "<td>".$row["stuId"]."</td>";
        echo "<td>".$row["lastName"]."</td>";
        echo "<td>".$row["firstName"]."</td>";
        echo "<td>".$row["major"]."</td>";
        echo "<td>".$row["credits"]."</td>";


    }



    mysqli_close($db_Connection);
    ?>
</body>
</html>
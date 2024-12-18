<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>

<body>
    <h2>Insert into the Customer Table</h2>

    <form id="register" name="register" method="POST" action="<?php echo $PHP_SELF;?>" onsubmit="return true">
        First Name:<input type="text" id="firstName" name="firstName"></input><br>
        Last Name:<input type="text" id="lastName" name="lastName"></input><br>
        Email:<input type="text" id="email" name="email"></input><br>
        Address:<input type="text" id="address" name="address"></input><br>
        Password:<input type="text" id="password" name="password"></input><br>
        Administrator:<input type="checkbox" id="administrator" name="administrator"></input><br>


        <br><br>

        <input type="submit" value="Add Record"></input>

    </form>

    <?php
    $db_location="localhost";
    $db_username="vau48469";
    $db_password="vau48469";
    $db_database="vau48469";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
    if ($_POST['administrator'] == "on") {
        $_POST['administrator'] = 1;
    } else {
        $_POST['administrator'] = 0;
    }

    $sql = "INSERT INTO customers VALUES (
    NULL, '".
    $_POST['lastName']."', '".
    $_POST['firstName']."', '".
    $_POST['email']."', '".
    $_POST['address']."', '".
    $_POST['password']."', '".
    $_POST['administrator']."')";

    echo "The SQL this is going to do the INSERT: <br>" . $sql;

    if ($_POST['firstName'] != "" && $_POST['lastName'] != "" ) {
        mysqli_query($db_Connection, $sql) or die ("The inesert did not work");
        echo "looks like the insert worked";
        $_POST['firstName'] == "";
    }

    $customers = mysqli_query($db_Connection, "SELECT * FROM customers") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);

    echo "<table border='1' style='border-collapse: collapse'";
    echo "<tr>
          <th>cid</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Admin</th>
          <th>Password</th>

          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["cid"]."</td>";
        echo "<td>".$row["lastName"]."</td>";
        echo "<td>".$row["firstName"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["address"]."</td>";
        echo "<td>".$row["administrator"]."</td>";
        echo "<td>".$row["password"]."</td>";



    }



    ?>
    <a href="index.html">go back</a>

</body>

</html>
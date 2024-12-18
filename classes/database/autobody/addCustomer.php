<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
</head>

<body>
<a href="index.html">Return to previous page</a>
<br>
    <h2>Insert into the Customer Table</h2>

    <form id="register" name="register" method="POST" action="<?php echo $PHP_SELF;?>" onsubmit="return true">
        First Name:<br><input type="text" id="fName" name="fName"></input><br>
        Last Name:<br><input type="text" id="lName" name="lName"></input><br>
        Address:<br><input type="text" id="addr" name="addr"></input><br>
        Phone:<br><input type="text" id="phone" name="phone"></input><br>    
        <br><br>
        <input type="submit" value="Add Record"></input>
        <br>
    </form>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
    $sql = "INSERT INTO Customer VALUES (
    NULL, '".
    $_POST['fName']."', '".
    $_POST['lName']."', '".
    $_POST['addr']."', '".
    $_POST['phone']."')";    
   

    echo "The SQL this is going to do the INSERT: <br>" . $sql;

    if ($_POST['fName'] != "" && $_POST['fName'] != "" ) {
        mysqli_query($db_Connection, $sql) or die ("The inesert did not work");
        echo "looks like the insert worked";
        $_POST['fName'] == "";
    }



    ?>
   

</body>

</html>
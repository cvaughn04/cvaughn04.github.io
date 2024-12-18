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
    <h2>Insert into the Repair Table</h2>

    <form id="register" name="register" method="POST" action="<?php echo $PHP_SELF;?>" onsubmit="return true">
        Description:<br><input type="text" id="repair_description" name="repair_description"></input><br>
        Time Required:<br><input type="text" id="time_required" name="time_required"></input><br>
        Cost:<br><input type="text" id="cost" name="cost"></input><br>
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
    
    $sql = "INSERT INTO Repair VALUES (
    NULL, '".
    $_POST['repair_description']."', '".
    $_POST['time_required']."', '".
    $_POST['cost']."')";    
   

    echo "The SQL this is going to do the INSERT: <br>" . $sql;

    if ($_POST['repair_description'] != "" && $_POST['repair_description'] != "" ) {
        mysqli_query($db_Connection, $sql) or die ("The inesert did not work");
        echo "looks like the insert worked";
        $_POST['repair_description'] == "";
    }



    ?>
   

</body>

</html>
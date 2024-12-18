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
    <h2>Rasie the repair cost</h2>

    <form id="register" name="register" method="POST" action="<?php echo $PHP_SELF;?>" onsubmit="return true">
        Factor of Increase:<br><input type="text" id="factor" name="factor"></input><br>
        <br><br>
        <input type="submit" value="Increase Repair Costs"></input>
        <br>
    </form>

    <?php
        $db_location="localhost";
        $db_username="c11019419v";
        $db_password="temppass";
        $db_database="c11019419v_RepairShop";

        $db_Connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Could not connect to the database");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "CALL raise_repair_cost(". $_POST['factor'] .");";
            echo "The SQL that is going to increase repair costs: <br>" . $sql;

            $result = mysqli_query($db_Connection, $sql);
            if (!$result) {
                die("Error: " . mysqli_error($db_Connection));
            }

            echo "Looks like the repair cost increase worked";
        }
    ?>

   

</body>

</html>
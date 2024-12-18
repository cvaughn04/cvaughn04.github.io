<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a Customer</title>
</head>

<body>
    <a href="index.html">Back to previous page</a>
    <br>
    <?php
        $db_location = "localhost";
        $db_username = "c11019419v";
        $db_password = "temppass";
        $db_database = "c11019419v_RepairShop";
        $db_Connection = mysqli_connect("$db_location", "$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
        /* Make a drop down to show all the workers */
        echo "
        <form id='getData' method='POST'>";

        $result=mysqli_query($db_Connection, "SELECT * FROM Customer") or die("drop down query did not work");
        
        echo "
        <br>Select a customer to update:
        <select name='customer_ID' id='customer_ID'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["customer_ID"]."'>".$row['fName']." ".$row['lName']."</option>";
        }
        echo "
        </select>
        <br><br>
        <input type='submit' value='Get the customer information'>
        </form>";
    ?>
    <br><br>
    <?php
    //** Now grab the data for the id that was selected above **/

    $sql ="SELECT * from Customer WHERE customer_ID='".$_POST["customer_ID"]."'";
    echo $sql;
    echo "<br><br>";
    $result=mysqli_query($db_Connection, $sql) or die("Get customer query didn't work");
    $row=mysqli_fetch_array($result);

    echo "
   
    <form id='update' name='update' method='POST' action='updateCustomer.php'>
    Worker ID:<br> <input type='text' id='customer_ID' name='customer_ID' value='".$row['customer_ID']."' readonly><br>
    First Name:<br> <input type='text' id=fName name='fName' value='".$row['fName']."'><br>
    Last Name:<br> <input type='text' id='lName' name='lName' value='".$row['lName']."'><br>
    Adress:<br> <input type='text' id='addr' name='addr' value='".$row['addr']."'><br>
    Phone Number:<br> <input type='text' id='phone' name='phone' value='".$row['phone']."'><br>
    <br>
    <input type='submit' value='Update Customer'>
    
    </form>
    <br><br>
    ";
    ?>
    <?php

    /* do the update here from the data above */
    if ($_POST['fName'] != "") {

        $sql = "UPDATE Customer SET 
            fName='" . $_POST['fName'] . "', 
            lName='" . $_POST['lName'] . "', 
            addr='" . $_POST['addr'] . "', 
            phone='" . $_POST['phone'] . "' 
            WHERE customer_ID='" . $_POST['customer_ID'] . "'";


        echo "<br>The INSERT SQL: <br>" . $sql . "<br><br>";

        mysqli_query($db_Connection, $sql) or die("The insert did not work");
        echo "Looks like the insert worked<br><br>";
        $_POST['fName'] = "";
    }
    ?>

    <br><br>

</body>

</html>
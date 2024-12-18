<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a customer</title>
</head>

<body>
    <?php
        $db_location = "localhost";
        $db_username = "vau48469";
        $db_password = "vau48469";
        $db_database = "vau48469";
        $db_Connection = mysqli_connect("$db_location", "$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
        /* Make a drop down to show all the workers */
        echo "
        <form id='getData' method='POST'>";

        $result=mysqli_query($db_Connection, "SELECT * FROM customers") or die("drop down query did not work");
        
        echo "
        <br>Select a customer to update:
        <select name='cid' id='cid'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["cid"]."'>".$row['firstName']." ".$row['lastName']."</option>";
        }
        echo "
        </select>
        <br><br>
        <input type='submit' value='Get the customers information'>
        </form>";
    ?>
    <br><br>
    <?php
    //** Now grab the data for the id that was selected above **/

    $sql ="SELECT * from customers WHERE cid='".$_POST["cid"]."'";
    echo $sql;
    echo "<br><br>";
    $result=mysqli_query($db_Connection, $sql) or die("Get customer query didn't work");
    $row=mysqli_fetch_array($result);

    echo "
   
    <form id='update' name='update' method='POST' action='updateCustomer.php'>
    Cust ID: <input type='text' id='cid' name='cid' value='".$row['cid']."' readonly><br>
    First Name: <input type='text' id=firstName name='firstName' value='".$row['firstName']."'><br>
    Last Name: <input type='text' id='lastName' name='lastName' value='".$row['lastName']."'><br>
    address: <input type='text' id='address' name='address' value='".$row['address']."'><br>
    password: <input type='text' id='password' name='password' value='".$row['password']."'><br>
    email: <input type='text' id='email' name='email' value='".$row['email']."'><br>
    administrator: <input type='text' id='administrator' name='administrator' value='".$row['administrator']."'><br>
    <br>
    <input type='submit' value='Update Customer'>
    
    </form>
    <br><br>
    ";
    ?>
    <?php

   
    /* do the update here from the data above */
    if ($_POST['firstName'] != "") {

        $sql = "UPDATE customers SET 
            firstName='" . $_POST['firstName'] . "', 
            lastName='" . $_POST['lastName'] . "', 
            address='" . $_POST['address'] . "', 
            password='" . $_POST['password'] . "' ,
            email='" . $_POST['email'] . "' ,
            administrator='" . $_POST['administrator'] . "' ,
            WHERE cid='" . $_POST['cid'] . "'";


        echo "<br>The INSERT SQL: <br>" . $sql . "<br><br>";

        mysqli_query($db_Connection, $sql) or die("The insert did not work");
        echo "Looks like the insert worked<br><br>";
        $_POST['firstName'] = "";
    }
    ?>

    <br><br>

</body>

</html>
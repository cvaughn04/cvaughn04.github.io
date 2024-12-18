<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete a Worker</title>
</head>

<body>
    <h2>Delete a Worker</h2>
    <a href="index.html">Back to Worker-Project Home</a>
    <?php
        $db_location = "localhost";
        $db_username = "c11019419v";
        $db_password = "temppass";
        $db_database = "c11019419v";
        $db_Connection = mysqli_connect("$db_location", "$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
        /* Make a drop down to show all the workers */
        echo "
        <form id='getData' method='POST'>";

        $result=mysqli_query($db_Connection, "SELECT * FROM Worker") or die("drop down query did not work");
        
        echo "
        <br>Select a worker to update:
        <select name='empId' id='empId'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["empId"]."'>".$row['firstName']." ".$row['lastName']."</option>";
        }
        echo "
        </select>
        <br><br>
        <input type='submit' value='Get the worker information'>
        </form>";
    ?>
    <br><br>
    <?php
    //** Now grab the data for the id that was selected above **/

    $sql ="SELECT * from Worker WHERE empId='".$_POST["empId"]."'";
    echo $sql;
    echo "<br><br>";
    $result=mysqli_query($db_Connection, $sql) or die("Get worker query didn't work");
    $row=mysqli_fetch_array($result);

    echo "
   
    <form id='update' name='update' method='POST' action='deleteWorker.php'>
    Worker ID: <input type='text' id='empId' name='empId' value='".$row['empId']."' readonly><br>
    First Name: <input type='text' id=firstName name='firstName' value='".$row['firstName']."' readonly><br>
    Last Name: <input type='text' id='lastName' name='lastName' value='".$row['lastName']."' readonly><br>
    Department Name: <input type='text' id='deptName' name='deptName' value='".$row['deptName']."' readonly><br>
    Date Hired: <input type='date' id='hireDate' name='hireDate' value='".$row['hireDate']."' readonly><br>
    Birth Date: <input type='date' id='birthDate' name='birthDate' value='".$row['birthDate']."' readonly><br>
    Salary: <input type='text' id='salary' name='salary' value='".$row['salary']."' readonly><br>
    <br>
    <input type='submit' value='Delete Worker'>
    
    </form>
    <br><br>
    ";
    ?>
    <?php

    /* do the update here from the data above */
    if ($_POST['firstName'] != "") {

        $sql = "DELETE FROM Worker WHERE empId='".$_POST["empId"]."'";

        echo "<br>The DELETE SQL: <br>" . $sql . "<br><br>";

        mysqli_query($db_Connection, $sql) or die("The insert did not work");
        echo "Looks like the delete worked<br><br>";
        $_POST['firstName'] = "";
    }
    ?>

    <br><br>

</body>

</html>
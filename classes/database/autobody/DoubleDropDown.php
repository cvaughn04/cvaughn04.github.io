<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a Worker</title>
</head>

<body>
   
    <?php
        session_start();
        
        $db_location = "localhost";
        $db_username = "dtucker";
        $db_password = "p0ss4Tucker";
        $db_database = "TUCKER";
        $db_Connection = mysqli_connect("$db_location", "$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 1
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getWorker' name='getWorker' method='POST'>";
        $getWorker = $_POST['getWorker'];
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
        <br><br>";
        echo "
        <input type='submit' name='worker' "; /*this name is how I fixed this submission */ echo " value='Get the worker information'>
        </form>
        <br><br>";
        
    
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 2
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getAssignment' name='getAssignment' method='POST'>";

        $sql = "SELECT * from Assign WHERE empId='".$_POST["empId"]."'";
        echo $sql;
        echo "<br>";
        echo "<br>";

        $result=mysqli_query($db_Connection, $sql) or die("2nd drop down query did not work");
        
        echo "
        <br>Select a worker's project:
        <select name='projNo' id='projNo'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["projNo"]."'>".$row['projNo']."</option>";
        }
        echo "
        </select>
        <br><br>
        <input type='submit' name ='assign'"; /*this name is how I fixed this submission */  echo "value='Get the worker information'>
        </form>
        <br><br>";

            
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //SUBMIT FUNCTION BLOCK
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //instead of referencing the POST's 
        //reference the submit buttons
        //below defines what happens in the event that each submit button is clicked
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if(isset($_POST['worker'])) {
            $_SESSION['employeeID'] = $_POST['empId'];
        
        } elseif (isset($_POST['assign'])) {
            $sql ="SELECT projNo, hoursAssigned, rating from Assign WHERE projNo='".$_POST["projNo"]."' AND empId='".$_SESSION['employeeID']."'";
            echo $sql;
            echo "<br><br>";
            $result=mysqli_query($db_Connection, $sql) or die("Get Assign data for the worker didn't work");
            $row=mysqli_fetch_array($result);


            //////////////////////////////////////////////////////////
            //if rating was null it wouldnt show in fields, this is fix
            if ($row['rating'] == NULL) {
                $rting = "NULL";
            } else {
                $rting = $row['rating'];
            }
            //////////////////////////////////////////////////////////
        
            echo "
            <form id='update' name='update' method='POST' action='DoubleDropDown.php'>
            Project ID: <input type='text' id='projNo' value='".$row['projNo']."'readonly><br>
            Employee ID: <input type='text' id='empId' value='".$_SESSION['employeeID']."'><br>
            Hours Assigned: <input type='text' id='hoursAssigned' value='".$row['hoursAssigned']."'><br>
            Rating: <input type='text' id='rating' value='".$rting."'><br>
            <br>
            <input type='submit' value='Update Worker'>
            
            </form>
            <br><br>
            ";

        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ?>
    <?php

    //if ($_POST['firstName'] != "") {



        /* Do update here using the data from the form above */
        /*
        $sql="UPDATE Worker SET 
        lastName = '".$_POST['lastName']."',
        firstName = '".$_POST['firstName']."',
        deptName = '".$_POST['deptName']."',
        birthDate = '".$_POST['birthDate']."',
        hireDate = '".$_POST['hireDate']."',
        salary = '".$_POST['salary']."'
        WHERE empId='".$_POST['empId']."';"
        ;

        echo "<br>The UPDATE SQL: <br>" . $sql . "<br><br>";

        mysqli_query($db_Connection, $sql) or die("The update did not work");
        echo "Looks like the update worked<br><br>";
        $_POST['firstName'] = "";
        */
    //}
    ?>

    <br><br>
    <a href="index.html">Back to Worker-Project Home</a>
    <br><br>
</body>

</html>
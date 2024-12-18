<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to and View the Job Table</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Verdana', sans-serif;
            background: black;

        }

        .mynavbar {
            width: 100%;
            height: 100px;
            background: #212f3d;


            color: #ecf0f1;
            padding: 0 40px;
        }

        .mynavbar-left {
            overflow: hidden;
            float: left;
        }

        .mynavbar-right {
            float: right;
            overflow: hidden;
        } 

        .mynavbar-right ul {
            padding: 0;
            margin: 0;
            list-style-type: none;
        } 

        .mynavbar-right ul li {
            float: right;


        } 

        .mynavbar-right ul li a {
            display: inline-block;
            padding: 35px 30px;
            color: inherit;
            text-decoration: none;
            -webkit-transition: .3s;
            -moz-transition: .3s;
            transition: .3s;
        } 

        .mynavbar-right ul li a:hover {
            color: #b3b6b7;
        }

        .mynavbar-right ul li:hover ul {
            display: block;
        }

        /* css untuk dropdown */
        .mynavbar-right ul li ul {
            position: absolute;
            background: #212f3d;
            border-top: 1px solid #2c3e50;
            display: none;
        }

        .mynavbar-right ul li ul li {
            float: none;
        }

        .mynavbar-right ul li ul li a {
            padding: 20px;
        } 


        .container {
            display: flex;
            background-color: grey;

            justify-content: space-between;
            height: auto;
        }

        .left-section {
            background-color: white;
            border-radius: 25px;
            margin: 30px;

            width: 50%;
            height: auto;
            padding: 20px;
        }

        .right-section {
            background-color: white;
            width: 50%;
            height: auto;
            border-radius: 25px;
            margin: 30px;



            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="mynavbar">
        <div class="mynavbar-left">
            <h2>Autobody Admin Page</h2>
        </div>
        <div class="mynavbar-right">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Manage Database</a>
                    <ul>
                        <li><a href="customers.php">View Customers</a><br></li>
                        <li><a href="addCustomer.php">Add Customers</a><br></li>
                        <li><a href="updateCustomer.php">Update Customers</a><br></li>
                        <li><a href="deleteCustomer.php">Delete Customers</a><br></li>
                        <li><a href="repairs.php">View repairs</a><br></li>
                        <li><a href="addRepair.php">Add Repairs</a><br></li>
                        <li><a href="logTriggerTable.php">View Job Trigger Table</a><br></li>
                        <li><a href="DoubleDropDown.php">Double Drop Down</a><br></li>
                        <li><a href="storedProcedure.php">Salary Procedure</a><br></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    

    <div class="container">
        <div class="left-section">


            <?php
        session_start();
        
        $db_location="localhost";
        $db_username="c11019419v";
        $db_password="temppass";
        $db_database="c11019419v_RepairShop";
        $db_Connection = mysqli_connect("$db_location", "$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 1
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getCustomer' name='getCustomer' method='POST'>";
        $getCustomer = $_POST['getCustomer'];
        $result=mysqli_query($db_Connection, "SELECT * FROM Customer") or die("drop down query did not work");
        
        echo "
        <br>Select the Customer that needs the job done:
        <select name='customer_ID' id='customer_ID'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["customer_ID"]."'>".$row['fName']." ".$row['lName']."</option>";
        }
        echo "
        </select>
        <br><br>";
        echo "
        <input type='submit' name='customer' "; /*this name is how I fixed this submission */ echo " value='Confirm Customer Selection'>
        </form>
        ";
        
    
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 2
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getCar' name='getCar' method='POST'>";

        $sql = "SELECT * from Automobile WHERE customer_ID='".$_POST["customer_ID"]."'";
        

        $result=mysqli_query($db_Connection, $sql) or die("2nd drop down query did not work");
        
        echo "
        <br>Select the Customer's car:
        <select name='car_ID' id='car_ID'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["car_ID"]."'>".$row['manufacture_year']." ".$row['make']. " " .$row['model']."</option>";
        }
        echo "
        </select>
        <br><br>
        <input type='submit' name ='getCar'"; /*this name is how I fixed this submission */  echo "value='Confirm the Selection for the Customers Car'>
        </form>
        ";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 3
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getRepair' name='getRepair' method='POST'>";
        $getRepair = $_POST['getRepair'];
        $result=mysqli_query($db_Connection, "SELECT * FROM Repair") or die("drop down query did not work");
        
        echo "
        <br>Select a Repair for the job:
        <select name='repair_ID' id='repair_ID'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["repair_ID"]."'>".$row['repair_description']. " $" .$row['cost']."</option>";
        }
        echo "
        </select>
        <br><br>";
        echo "
        <input type='submit' name='repair' "; /*this name is how I fixed this submission */ echo " value='Confirm Repair Selection'>
        </form>
        ";

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //FORM 4
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        echo "
        <form id='getMechanic' name='getMechanic' method='POST'>";
        $getMechanic = $_POST['getMechanic'];
        $result=mysqli_query($db_Connection, "SELECT * FROM Mechanic") or die("drop down query did not work");
        
        echo "
        <br>Select a Mechanic for the job:
        <select name='mechanic_ID' id='mechanic_ID'>
        <option value='----------'>-----------</option>";
        while ($row=mysqli_fetch_array($result)) 
        {
            echo "<option value='".$row["mechanic_ID"]."'>".$row['mechanic_name']. ":  $" .$row['rate']."/hr</option>";
        }
        echo "
        </select>
        <br><br>";
        echo "
        <input type='submit' name='mechanic' "; /*this name is how I fixed this submission */ echo " value='Confirm Mechanic Selection and Add Job'>
        </form>
        ";
        

            
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //SUBMIT FUNCTION BLOCK
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //instead of referencing the POST's 
        //reference the submit buttons
        //below defines what happens in the event that each submit button is clicked
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if(isset($_POST['customer'])) {
            $_SESSION['customerID'] = $_POST['customer_ID'];
            echo "<br>";
            echo "Adding job to the job table with the following info";
            echo "<ul>";
               
                echo "<li>";
                echo "Car ID: " . $_SESSION['carID'];
                echo "</li>";
                echo "<li>";
                echo "Mechanic ID: " . $_SESSION['mechanicID'];
                echo "</li>";
                echo "<li>";
                echo "Repair ID: " . $_SESSION['repairID'];
                echo "</li>";


            echo "</ul>";
        
        } elseif(isset($_POST['getCar'])) {
            $_SESSION['carID'] = $_POST['car_ID'];
            echo "<br>";
            echo "Adding job to the job table with the following info";
            echo "<ul>";
               
                echo "<li>";
                echo "Car ID: " . $_SESSION['carID'];
                echo "</li>";
                echo "<li>";
                echo "Mechanic ID: " . $_SESSION['mechanicID'];
                echo "</li>";
                echo "<li>";
                echo "Repair ID: " . $_SESSION['repairID'];
                echo "</li>";


            echo "</ul>";
        
        } elseif(isset($_POST['repair'])) {
            $_SESSION['repairID'] = $_POST['repair_ID'];
            echo "<br>";
            echo "Adding job to the job table with the following info";
            echo "<ul>";
               
                echo "<li>";
                echo "Car ID: " . $_SESSION['carID'];
                echo "</li>";
                echo "<li>";
                echo "Mechanic ID: " . $_SESSION['mechanicID'];
                echo "</li>";
                echo "<li>";
                echo "Repair ID: " . $_SESSION['repairID'];
                echo "</li>";


            echo "</ul>";
        
        } elseif (isset($_POST['mechanic'])) {
            $_SESSION['mechanicID'] = $_POST['mechanic_ID'];

            $sql = "INSERT INTO Job VALUES (
                NULL, '".
                $_SESSION['carID']."', '".
                $_POST['mechanic_ID']."', '".
                $_SESSION['repairID']."', ".
                "NOW()".", ".
                "NULL)";   
             


            echo "<br>";
            echo "Adding job to the job table with the following info";
            echo "<ul>";
               
                echo "<li>";
                echo "Car ID: " . $_SESSION['carID'];
                echo "</li>";
                echo "<li>";
                echo "Mechanic ID: " . $_SESSION['mechanicID'];
                echo "</li>";
                echo "<li>";
                echo "Repair ID: " . $_SESSION['repairID'];
                echo "</li>";


            echo "</ul>";
           


            

            mysqli_query($db_Connection, $sql);
            $_SESSION['customerID'] = "";
            $_SESSION['carID'] = "";
            $_SESSION['repairID'] = "";
            $_SESSION['mechanicID'] = "";

          

        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ?>

        </div>
        <div class="right-section">

            <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v_RepairShop";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    

    $customers = mysqli_query($db_Connection, "SELECT * FROM Job") or die ("The query didnt work");

    $numRecords = mysqli_num_rows($customers);

    echo "<table border='1'";
    echo "<tr>
          <th>job_ID</th>
          <th>car_ID</th>
          <th>mechanic_ID</th>
          <th>estimate_ID</th>
          <th>job_date</th>
          <th>date_completed</th>
          </tr>";

    while($row = mysqli_fetch_array($customers)) {
        echo "<tr>";
        echo "<td>".$row["job_ID"]."</td>";
        echo "<td>".$row["car_ID"]."</td>";
        echo "<td>".$row["mechanic_ID"]."</td>";
        echo "<td>".$row["estimate_ID"]."</td>";
        echo "<td>".$row["job_date"]."</td>";
        echo "<td>".$row["date_completed"]."</td>";

    }
    mysqli_close($db_Connection);
   
    ?>
        </div>
    </div>



    <br><br>
    <a href="../index.html">Back to Worker-Project Home</a>
    <br><br>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Worker</title>
</head>

<body>
    <h2>Insert into the Worker Table</h2>

    <form id="register" name="register" method="POST" action="<?php echo $PHP_SELF;?>" onsubmit="return true">
        First Name:<input type="text" id="firstName" name="firstName"></input><br>
        Last Name:<input type="text" id="lastName" name="lastName"></input><br>
        Date Hired:<input type="date" id="hireDate" name="hireDate"></input><br>
        Birth Date:<input type="date" id="birthDate" name="birthDate"></input><br>
        Salary:<input type="text" id="salary" name="salary"></input><br>
        Dept Name:<input type="text" id="deptName" name="deptName"></input><br>


        <br><br>

        <input type="submit" value="Add Record"></input>

    </form>

    <?php
    $db_location="localhost";
    $db_username="c11019419v";
    $db_password="temppass";
    $db_database="c11019419v";

    $db_Connection=mysqli_connect("$db_location","$db_username", "$db_password", "$db_database") or die("Could not connect to the database");
    
    $sql = "INSERT INTO Worker VALUES (
    NULL, '".
    $_POST['lastName']."', '".
    $_POST['firstName']."', '".
    $_POST['deptName']."', '".
    $_POST['birthDate']."', '".
    $_POST['hireDate']."', '".
    $_POST['salary']."')";

    echo "The SQL this is going to do the INSERT: <br>" . $sql;

    if ($_POST['firstName'] != "" && $_POST['lastName'] != "" ) {
        mysqli_query($db_Connection, $sql) or die ("The inesert did not work");
        echo "looks like the insert worked";
        $_POST['firstName'] == "";
    }



    ?>
    <a href="index.html">go back</a>

</body>

</html>
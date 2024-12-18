<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js" defer></script>

</head>
<body>
    <?php include 'config.php';?>
    <?php include 'nav.php';?>

    <?php
        $users = mysqli_query($db_Connection, "SELECT * FROM users") or die ("The query didnt ork");

    $numRecords = mysqli_num_rows($users);

    echo "<table border='1' 
    style='
        background-color: var(--nav-color);
        border-color: var(--footer-color);
        color: var(--text-color);
        align-self: center;
        width: 70%;
        margin-top: 50px;
        
    '";
    echo "<tr>
          <th>id</th>
          <th>admin</th>
          <th>username</th>
          <th>email</th>
          <th>password</th>
          </tr>";

    while($row = mysqli_fetch_array($users)) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["admin"]."</td>";
        echo "<td>".$row["username"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["password"]."</td>";

    }



    mysqli_close($db_Connection);
    ?>
    
</body>

</html>


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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateAdmin'])) {
            foreach ($_POST['userId'] as $userId) {
                $adminStatus = isset($_POST['admin'][$userId]) ? 1 : 0;
                $sql = "UPDATE users SET admin=$adminStatus WHERE id=$userId";
                mysqli_query($db_Connection, $sql);
            }
        }

        $users = mysqli_query($db_Connection, "SELECT id, username, email, admin FROM users") or die ("The query didn't work");

        echo "<form method='POST' action='' style='width: 70%; margin-top: 50px; align-self: center;'>";

        echo "<table border='1' 
        style='
            background-color: var(--nav-color);
            border-color: var(--footer-color);
            color: var(--text-color);
            width: 100%;
        '>";

        echo "<tr>
              <th>Username</th>
              <th>Email</th>
              <th>Set as Admin</th>
              </tr>";

        while($row = mysqli_fetch_array($users)) {
            $isAdminChecked = $row["admin"] ? "checked" : "";

            echo "<tr>";
            echo "<td>".$row["username"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td style='text-align: center'>
                  <input type='hidden' name='userId[]' value='".$row['id']."'>
                  <input type='checkbox' name='admin[".$row['id']."]' $isAdminChecked />
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<button type='submit' name='updateAdmin' style='margin-top: 20px;'>Update Admin Status</button>";
        echo "</form>";

        mysqli_close($db_Connection);
    ?>
</body>
</html>

<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['id']; 

$userQuery = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($db_Connection, $userQuery);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE users SET username='$username', email='$email', password='$hashedPassword' WHERE id='$userId'";
    } else {
        $updateQuery = "UPDATE users SET username='$username', email='$email' WHERE id='$userId'";
    }

    if (mysqli_query($db_Connection, $updateQuery)) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        echo "Profile updated successfully!";
        header("Location: index.php");
    } else {
        echo "Error updating profile: " . mysqli_error($db_Connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</head>
<body>
<div class="content-container">
<nav class="navbar">
          <a href="index.php" class="navContainer left">
              <ion-icon name="logo-docker" class="logo"></ion-icon>
              <div class="logo">
                v-tackle
              </div>
          </a>
            <div class="navContainer right">
      
                <a href="index.php" class="navItem">Home</a>
             
                <ion-icon name="moon-outline" class="navItem" onclick="toggleTheme()"></ion-icon>
            </div>

        </nav>
        <div class="form">
        <h2 class="login-text">Edit Your Profile</h2>
    <form method="POST" action="">
        <label class="login-text" for="username">Username:</label>
        <input class="login-text" type="text" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label class="login-text" for="email">Email:</label>
        <input class="login-text" type="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label class="login-text" for="password">New Password (leave blank if not changing):</label>
        <input class="login-text" type="password" name="password" placeholder="Enter new password"><br>

        <button type="submit">Update Profile</button>
    </form>
</div>

</div>
</body>
</html>

<?php
mysqli_close($db_Connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loginStyles.css">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="login.js" defer></script>
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
      <?php include 'config.php'; ?>

      <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (id, admin, username, email, password) VALUES (NULL, 0, '$username', '$email', '$password')";

            if (mysqli_query($db_Connection, $sql)) {
                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($db_Connection, $sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['admin'] = $user['admin'];

                    header("Location: index.php");
                    exit();
                }
            } else {
                echo "<p style='color: white'>Sign up failed</p>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($db_Connection, $sql) or die ("<p style='color: white'>Query failed</p>");

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    echo "<p style='color: white'>Login successful</p>";
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['admin'] = $user['admin'];

                    header("Location: index.php");
                    exit();
                } else {
                    echo "<p style='color: white'>Invalid password</p>";
                }
            } else {
                echo "<p style='color: white'>User not found</p>!";
            }
        }
        ?>



        <div class="form">
    <form class="register-form" action="login.php" method="POST" style="display: none">
        <input class="login-text" type="text" name="username" placeholder="name" required/>
        <input class="login-text" type="email" name="email" placeholder="email address" required/>
        <input class="login-text" type="password" name="password" placeholder="password" required/>
        <button type="submit" name="register">Create Account</button>
        <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>

    <form class="login-form" action="login.php" method="POST">
        <input class="login-text" type="email" name="email" placeholder="email address" required/>
        <input class="login-text" type="password" name="password" placeholder="password" required/>
        <button type="submit" name="login">Login</button>
        <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>

</div>

</div>
<?php include 'footer.php'; ?>
<script src="script.js" defer></script>

</html>

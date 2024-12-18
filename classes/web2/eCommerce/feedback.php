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




        <div class="form">
        <h2>Item Feedback</h2>
    <form class="login-form"name="feedback" id="feedback" action="mailConfirm.php" method="post">
        Name <input class="login-text" type="text" id="CustName" name="CustName"><br>
        Email <input class="login-text" type="email" id="Email" name="Email"><br><br>
        <?php
            $result = mysqli_query($db_Connection, "SELECT DISTINCT description FROM products") or die("Products drop didn't work");
            echo "What product are you leaving feedback for? ";
            echo "<select name='product' id='product'>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<option value='".$row['description']."'>".$row['description']."</option>";
            }
            echo "</select>";
        ?>
        <br><br>Comments<br>
        <textarea class="login-text" id="Comments" name="Comments" cols="50" rows="10"></textarea>
        <br>
        <input class="login-text" name="Submit" type="submit" value="Submit">
        <br><br>
    </form>

</div>

</div>
<script src="script.js" defer></script>
    
</body>
</html>
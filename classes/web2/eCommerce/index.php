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
</head>
<body>
  <div class="content-container">
      <?php include 'nav.php'; ?>
      <?php
            session_start();

            // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            //   echo "<div class='navItem'><p style='color: white'>Must login first</p></div>";
            //     header("Location: login.php");
            //     exit;
            // }

            ?>


        <div class="image-container">
            <img  src="https://us.images.westend61.de/0000903046pw/side-view-of-mature-man-fishing-in-river-by-mountain-CAVF34446.jpg">
            <div class="text-overlay">
                <div style="font-size: 48px">Need gear for your next trip?</div>
                <div class="">Select rods and lures up to 40% off</div>
                <div class="button-container">
                    <a href="products.php" class="shop-now">Shop Now</a>
                  </div>
            </div>
            </div>
        </div>
        
        
        
        <?php include 'footer.php'; ?>
    </div>

    
    <script src="script.js" defer></script>
  </body>

</html>

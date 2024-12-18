<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nav</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
    <script src="canvasScript.js"></script>


</head>
<body>
<nav class="navbar">
          <a href="index.php" class="navContainer left">
              <ion-icon name="logo-docker" class="logo"></ion-icon>
              <div class="logo">
                v-tackle
              </div>
          </a>
          <?php
            session_start();
            if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
              echo "<p class='navText' style='margin-right: 20%'>Welcome, " . $_SESSION['username'] . "</p>";
            }

            ?>
            <div class="navContainer right">
            <?php
            session_start();
            if ( $_SESSION['admin'] == 1) {
              echo "<div class='navItem dropdown'>
                    <a href='#' class='navItem'>Admin</a>
                    <div class='dropdown-content' style='z-index: 2; margin-top: 25px;'>
                        <a href='addProduct.php'>Add Product</a>
                        <a href='viewUsers.php'>View users</a>
                        <a href='editAdmins.php'>Edit Admins</a>
                        <a href='viewProducts.php'>View Products</a>
                        <a href='feedbackView.php'>View Feedback</a>

                    </div>
                </div>";
            }

            ?>
                <a href="index.php" class="navItem">Home</a>
                <div class="navItem dropdown">
                    <a href="products.php" class="navItem">Products</a>
                    <div class="dropdown-content" style="z-index: 2; margin-top: 25px;">
                        <a href="products.php?product=rods">Rods</a>
                        <a href="products.php?product=reels">Reels</a>
                        <a href="products.php?product=lures">Lures</a>
                    </div>
                </div>
                <a href="#" id="locationLink" class="navItem" style="margin-left: 5px;" onclick="requestLocation()">
                  <ion-icon name="location-outline" class="navText" style="margin-bottom: 3px; margin-right: 3px;"></ion-icon>
                  Find a store
                </a>


                <!-- <a href="#" class="navItem">More</a> -->
                <?php
                session_start();

                if ($_SESSION['logged_in'] == false) {
                  echo "<a href='login.php' class='navItem' style=' margin-left: 5px;'>
                          <ion-icon name='person-outline' class='navText' style='margin-bottom: 3px; margin-right: 3px;'></ion-icon>
                          Login
                        </a>
                  ";
                } else {
                  echo "<a href='logout.php' class='navItem' style=' margin-left: 5px;'>
                          <ion-icon name='exit-outline' class='navText' style='margin-bottom: 3px; margin-right: 3px;'></ion-icon>
                          Logout
                        </a>
                  ";
                }
                ?>

                <a href="checkout.php" class="navItem" style=" margin-left: 5px;">
                    <ion-icon name="cart-outline" class="navText" style="margin-bottom: 3px; margin-right: 3px;"></ion-icon>
                    Cart
                  </a>

                  <div class="navItem dropdown" style="margin: 0; padding: 0;">
                      <a href="feedback.php" class="navItem">Customer Service</a>
                      <div class="dropdown-content" style="z-index: 2; margin-top: 25px;">
                          <a href="feedback.php">Feedback</a>
                      </div>
                  </div>
                 

                  <?php
                session_start();

                if ($_SESSION['logged_in'] == true) {
                  echo "
                        <a href='pastPurchases.php' class='navItem' style=' margin-left: 5px;'>
                          <ion-icon name='card-outline' class='navText' style='margin-bottom: 3px; margin-right: 3px;'></ion-icon>
                          Purchases
                        </a>
                  
                        <a href='editUser.php' class='navItem' style=' margin: 0;'>
                          <ion-icon name='settings-outline' class='navText' style='margin-bottom: 3px;'></ion-icon>
                        </a>

                        <a href='javascript:void(0)' class='navItem' style='margin-left: 20;' onclick='openModal()'>
                          <ion-icon name='notifications-outline' class='navText' style='margin-bottom: 3px;'></ion-icon>
                          <div style='background-color: #F15B50; height: 7px; width: 7px; border-radius: 5px; position: absolute; margin-left: 10px;'></div>
                        </a>

                  ";
                }
                ?>

               
                <ion-icon name="moon-outline" class="navItem" onclick="toggleTheme()"></ion-icon>
            </div>

            <!-- Modal Structure -->
            
            
          </nav>
          <div id="notificationsModal" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal()">&times;</span>
                <div class="modal-text">Coupon Scratch off</div>
                
                <div style="position: relative; width: 300; height: 300;"> 
                  <canvas id="scratchCanvas" width="300" height="300" style="border-radius: 10px; position: absolute; top: 0; left: 0;"></canvas>
                  <img src="10.jpg" width="300" height="300" style="position: absolute; border-radius: 10px; top: 0; left: 0; width: 300; height: 300;"></img>
                </div>

            
            
            </div>

          </div>


        <script>
          async function getLocationByIP() {
            try {
              const response = await fetch("https://ipapi.co/json/");
              const data = await response.json();
              return {
                city: data.city,
                region: data.region,
                country: data.country_name,
                latitude: data.latitude,
                longitude: data.longitude
              };
            } catch (error) {
              console.error("Error fetching location by IP:", error);
              return null;
            }
          }

          function requestLocation() {
            getLocationByIP().then(ipLocation => {
              if (ipLocation) {
                console.log(ipLocation);
                const locationLink = document.getElementById("locationLink");
                locationLink.innerHTML = "<ion-icon name='location-outline' class='navText' style='margin-bottom: 3px; margin-right: 3px;'></ion-icon>";
                locationLink.innerHTML += ipLocation.city ? ipLocation.city : "Find a store";
              } else {
                console.error("Could not get location.");
              }
            }).catch(error => {
              console.error("Error getting location by IP:", error);
            });
          }

          // Add event listener to the button after the DOM is fully loaded
          document.getElementById("locationButton").addEventListener("click", requestLocation);


        

        </script>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="stylesheet" href="styles.css">

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
        <h2>Message</h2>
    <?php
        // Parameters for the php mail function
        // to, subject, message, header

        $to = $_POST['Email'];

        $subject = "Some mail from the Web Dev II Class";

        $message = 
        "\r\n".
        "From: ".$_POST["CustName"]."\r\n".
        "Product Name: ".$_POST['product']."\r\n".
        "Comments:\r\n".$_POST['Comments']."\r\n";

        $header = "From: noreply@cis.pennwest.edu";

        echo "To: ".$to."<br>";
        echo "Subject: ".$subject."<br>";
        echo "Message: ".$message."<br>";
        echo "Header: ".$header."<br>";

        /*****  Send the message ***********/

        try
        {
            mail($to, $subject, $message, $header);
            echo "Message was sent";
        }
        catch (Exception $e)
        {
            echo "Message did not send";
        }

        $date = date("Y-m-d H:i:s");
        $feedbackEntry = $message;

        $existingFeedback = file_exists("feedback.txt") ? file_get_contents("feedback.txt") : "";

        file_put_contents("feedback.txt", $feedbackEntry . $existingFeedback);

        echo "Feedback saved successfully.<br>";

    ?>

</div>

</div>
<script src="script.js" defer></script>
    
</body>
</html>



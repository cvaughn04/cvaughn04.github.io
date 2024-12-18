<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="stylesheet" href="cartStyles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="login.js" defer></script>
</head>
<body>
    
</body>
</html>


<?php
session_start();
include 'config.php';
include 'nav.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['id'];

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "Your cart is empty.";
    // echo $userId;

    exit();
}


$timestamp = date("Y-m-d H:i:s");
$discount = floatval($_POST['discount']) ?? 1;

$dis = $discount;
if ( isset($_SESSION['discount']) ) {
    $dis -= $_SESSION['discount'];
}
// echo $_SESSION['cart']['discount'];
echo $dis;
$sql = "INSERT INTO orders (id, user_id, order_time, discount) VALUES (NULL, $userId, NULL, $dis)";
// mysqli_query($db_Connection, $sql) or die ("The ineSSSsert did not work");

if (mysqli_query($db_Connection, $sql)) {
    $lastId = mysqli_insert_id($db_Connection);

    foreach ($_SESSION['cart']  as $index => $item) {
        $productId = $item['id'];
        $quantity = 1;

        $sql2 = "INSERT INTO order_line_items VALUES (NULL, '$lastId', '$productId', '$quantity')";
        mysqli_query($db_Connection, $sql2);
    }




} else {
    echo "Purchase unsuccessfull";

}

echo "<div class='checkout-button'>Purchase successfull!</div>";


$_SESSION['cart'] = [];
unset($_SESSION['cart']);

header('Location: orderConfirmation.php');
exit();
?>

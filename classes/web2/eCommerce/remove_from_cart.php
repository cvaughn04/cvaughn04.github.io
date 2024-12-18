<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];

    // Check if the cart session is set
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Remove the item from the cart
        unset($_SESSION['cart'][$index]);
        
        // Reindex the array to maintain numeric keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Redirect back to the cart page
    header('Location: checkout.php');
    exit();
}
?>

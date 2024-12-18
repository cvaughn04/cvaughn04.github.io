<?php
session_start(); // Start the session

if (isset($_POST['discount'])) {
    $_SESSION['discount'] = $_POST['discount'];  // Set discount to session
    echo "Session variable 'discount' set to " . $_SESSION['discount'];
} else {
    echo "No discount value provided.";
}
?>

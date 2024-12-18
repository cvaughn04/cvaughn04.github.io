<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url']; // Get the image URL
    // Check if the cart session is set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to cart
    $_SESSION['cart'][] = [
        'id' => $id,
        'description' => $description,
        'price' => $price,
        'image_url' => $image_url, // Save the image URL
    ];

    // Return a success response
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>

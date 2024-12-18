<?php
include 'config.php'; // Database connection

$category = isset($_POST['category']) ? $_POST['category'] : '';
$subcategory = isset($_POST['subcategory']) ? $_POST['subcategory'] : '';

// Build the SQL query based on the selected category and subcategory
$query = "SELECT * FROM products WHERE 1";

if ($category) {
    $query .= " AND category = '$category'";
}

if ($subcategory) {
    $subcategoryFormatted = str_replace('-', ' ', $subcategory); // Convert the subcategory back to a string
    $query .= " AND subcategory = '$subcategoryFormatted'";
}

$result = mysqli_query($db_Connection, $query);

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [
        'id' => $row['id'],
        'description' => $row['description'], // Updated to use 'description'
        'price' => $row['price'],
        'image_url' => $row['image_url'],
    ];
}

echo json_encode($products);

mysqli_close($db_Connection);
?>

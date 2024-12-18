<?php
$product_description = filter_input(INPUT_POST, 'product_description');
$list_price = filter_input(INPUT_POST, 'list_price');
$discount_percent = filter_input(INPUT_POST, 'discount_percent');
$discount = $list_price * $discount_percent * .01;
$discount_price = $list_price - $discount;


?>


<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <h1>This page is under construction</h1>

        <label>Product Description:</label>
        <span><?php echo $product_description; ?></span><br>

        <label>List Price:</label>
        <span><?php echo "$".number_format($list_price,2); ?></span><br>

        <label>Discount Percent:</label>
        <span><?php echo number_format($discount_percent)."%"; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo number_format($discount,2); ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo number_format($discount_price,2); ?></span><br>
    </main>
</body>
</html>
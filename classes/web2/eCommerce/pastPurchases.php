<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="stylesheet" href="cartStyles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="login.js" defer></script>
    <style>
        .order-container {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .order-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .line-item {
            display: flex;
            align-items: center;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 10px;
            margin-top: 10px;
            background-color: #ffffff;
        }
        .line-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 10px;
            border-radius: 4px;
        }
        .line-item p {
            margin: 0;
        }
    </style>
</head>
<body>
  <div class="content-container">
      <?php include 'nav.php'; ?>
      <?php include 'config.php'; ?>

      <?php
        // Start the session to access session variables
        session_start();

        // Get the user ID from the session
        $user_id = $_SESSION['id'];

        // Query to get orders for the signed-in user
        $orderQuery = "SELECT * FROM orders WHERE user_id = '$user_id'";
        $orderResult = mysqli_query($db_Connection, $orderQuery);

        // Check if there are orders
        if (mysqli_num_rows($orderResult) > 0) {
            while ($order = mysqli_fetch_assoc($orderResult)) {
                $order_id = $order['id'];
                $order_timestamp = $order['order_time'];
                $order_total = 0; // Initialize order total
                $coinflip = $order['discount'];


                echo "<div class='order-container'>";
                echo "<div class='order-header'>Order ID: $order_id</div>";
                echo "<p>Order Date: $order_timestamp</p>";

                // Query to get line items for the current order
                $lineItemQuery = "SELECT * FROM order_line_items WHERE order_id = '$order_id'";
                $lineItemResult = mysqli_query($db_Connection, $lineItemQuery);

                // Check if there are line items
                if (mysqli_num_rows($lineItemResult) > 0) {
                    while ($lineItem = mysqli_fetch_assoc($lineItemResult)) {
                        $product_id = $lineItem['product_id'];
                        $quantity = $lineItem['quantity'];

                        // Query to get product details
                        $productQuery = "SELECT * FROM products WHERE id = '$product_id'";
                        $productResult = mysqli_query($db_Connection, $productQuery);
                        $product = mysqli_fetch_assoc($productResult);

                        // Display product details
                        if ($product) {
                            $product_description = $product['description'];
                            $product_image = $product['image_url'];
                            $product_price = $product['price'];
                            $order_total += $product_price * $quantity;


                            echo "<div class='line-item'>";
                            echo "<img src='$product_image' alt='$product_description' />";
                            echo "<div>";
                            echo "<p><strong>Description:</strong> $product_description</p>";
                            echo "<p><strong>Price:</strong> $$product_price</p>";
                            echo "<p><strong>Quantity:</strong> $quantity</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }

                    if ($coinflip == 1) {
                        echo "<p><strong>Total:</strong> $" . number_format($order_total, 2) . "</p>";
                    } else {
                        echo "<p><strong>Pre Total:</strong> $" . number_format($order_total, 2) . "</p>";
                        if ($coinflip == 0.9) {
                            echo "<p style='color: green;'><strong>Coupon: -</strong> $" . number_format($order_total * 0.1, 2) . "</p>";
                            echo "<p><strong>End Total:</strong> $" . number_format($order_total* 0.9, 2) . "</p>";
                        } else if ($coinflip == 0.4) {
                            echo "<p style='color: green;'><strong>Won Coinflip: -</strong> $" . number_format($order_total * 0.5, 2) . "</p>";
                            echo "<p style='color: green;'><strong>Coupon: -</strong> $" . number_format($order_total * 0.1, 2) . "</p>";
                            echo "<p><strong>End Total:</strong> $" . number_format($order_total* 0.4, 2) . "</p>";

                            
                        } else if ($coinflip == 0.5){
                            echo "<p style='color: green;'><strong>Won Coinflip: -</strong> $" . number_format($order_total * 0.5, 2) . "</p>";
                            echo "<p><strong>End Total:</strong> $" . number_format($order_total* 0.5, 2) . "</p>";

                        } else if ($coinflip == 1.4) {
                            echo "<p style='color: red;'><strong>Lost Coinflip: +</strong> $" . number_format($order_total * 0.5, 2) . "</p>";
                            echo "<p style='color: green;'><strong>Coupon: -</strong> $" . number_format($order_total * 0.1, 2) . "</p>";
                            echo "<p><strong>End Total:</strong> $" . number_format($order_total* 1.4, 2) . "</p>";

                        } else if ($coinflip == 1.5) {
                            echo "<p style='color: red;'><strong>Lost Coinflip: +</strong> $" . number_format($order_total * 0.5, 2) . "</p>";
                            echo "<p><strong>End Total:</strong> $" . number_format($order_total* 1.5, 2) . "</p>";

                        }
                    }

                } else {
                    echo "<p>No line items found for this order.</p>";
                }
                echo "</div>"; // Close order-container
            }
        } else {
            echo "<p>No orders found for this user.</p>";
        }
        ?>
      
      <script src="script.js" defer></script>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

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
<div id="coinFlipPopup" class="popup hidden">
            <div class="popup-content">
                <h3 id="coinFlipResult"></h3>
                <button id="confirmCheckout" class="popup-button">Confirm and Checkout</button>
                <!-- <button id="cancelCheckout" class="popup-button">Cancel</button> -->
            </div>
        </div>
  <div class="content-container">
      <?php include 'nav.php'; ?>
      <?php include 'config.php'; ?>

      <div class="cart-section">
        <h2>Your Cart</h2>

        <div class="cart-items">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="cart-item">
                        <div class="item-details">
                        <!-- alt="<?php echo "oops"; ?>" -->
                        <!-- <?php echo "<img src='".$item['image_url']."'"." style='max-width: 100px; max-height: 100px; width: auto; height: auto; margin-right: 10px;' />"; ?> -->

                            <img src='<?php echo $item['image_url']; ?>' style="max-width: 100px; max-height: 100px; width: auto; height: auto; margin-right: 10px;" />
                            <h3><?php echo $item['description']; ?></h3>
                            <p>Price: $<?php echo $item['price']; ?></p>
                            <label for="quantity<?php echo $item['id']; ?>">Quantity:</label>
                            <input type="number" id="quantity<?php echo $item['id']; ?>" name="quantity<?php echo $item['id']; ?>" min="1" value="1">
                        </div>
                        <div class="item-total">
                            <p>Total: <span class="item-price">$<?php echo $item['price']; ?></span></p>
                        </div>
                        <div class="remove-item">
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <h3>Cart Summary</h3>
            <p id="total-price">
                Total: $
                <?php
                $totalPrice = 0;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $totalPrice += $item['price'];
                    }
                }
                echo number_format($totalPrice, 2);
                ?>
            </p>
        </div>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0): ?>
            <?php else: ?>
            <form action="purchase.php" method="POST">
                <input type="hidden" id="discount" name="discount" value="1"> <!-- Default value is 1 (no discount) -->
                <button type="button" class="coin-flip-button" onclick="flipCoinForDiscount()">Flip a Coin for a Discount</button>
                <button type="submit" class="checkout-button">Proceed to Checkout</button>
            </form>        
                    <?php endif; ?>

        <?php else: ?>
            <button class="checkout-button" onclick="window.location.href='login.php'">Login to Checkout</button>
        <?php endif; ?>
      </div>

      <!-- <?php include 'footer.php'; ?> -->
      <script src="script.js" defer></script>
      
    <script>
        function flipCoinForDiscount() {
            const result = Math.random() < 0.5 ? 'Heads' : 'Tails';
            const discountInput = document.getElementById('discount');
            const popup = document.getElementById('coinFlipPopup');
            const resultText = document.getElementById('coinFlipResult');
            const confirmButton = document.getElementById('confirmCheckout');

            // Update the popup text based on the coin flip result
            if (result === 'Heads') {
                resultText.textContent = 'Heads! You get a 50% discount!';
                discountInput.value = 0.5; // Set the discount value to 50%
            } else {
                resultText.textContent = 'Tails! you pay 50% more.';
                discountInput.value = 1.5; // Set the discount value to no discount
            }

            // Show the popup
            popup.classList.remove('hidden');

            // Handle confirm button click
            confirmButton.onclick = () => {
                popup.classList.add('hidden'); // Hide the popup
                document.querySelector('form[action="purchase.php"]').submit(); // Submit the form
            };
        }


    </script>
  </div>
</body>
</html>



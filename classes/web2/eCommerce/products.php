<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Selection</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loginStyles.css">
    <link rel="stylesheet" href="productStyles.css">

    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <div class="content-container">
      <?php include 'nav.php'; ?>
      <?php include 'config.php'; ?>
      
      <div class="product-selection">
        <h2>Select Products</h2>
        <label for="product-type">Product Type:</label>
        <select id="product-type" onchange="updateSubcategories(); fetchProducts()">
            <option value="">Select Product</option>
            <option value="rods">Rods</option>
            <option value="reels">Reels</option>
            <option value="lures">Lures</option>
        </select>

        <label for="subcategory">Subcategory:</label>
        <select id="subcategory" onchange="fetchProducts()" disabled>
            <option value="">View All</option>
        </select>
      </div>

      <div id="product-grid" class="product-grid">
      </div>

  </div>
  <?php include 'footer.php'; ?>

  <script src="products.js" ></script>
  <script src="script.js" defer></script>


</body>
</html>

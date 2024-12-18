<?php
include 'config.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch the product details from the database
    $query = mysqli_query($db_Connection, "SELECT * FROM products WHERE id='$productId'");
    $product = mysqli_fetch_array($query);
} else {
    die("Product ID not specified.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image_url = $_POST['existing_image']; // Store the existing image URL by default
    $price = $_POST['price'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $description = $_POST['description'];

    // Handle product deletion
    if (isset($_POST['delete'])) {
        $deleteQuery = "DELETE FROM products WHERE id='$productId'";
        if (mysqli_query($db_Connection, $deleteQuery)) {
            echo "Product deleted successfully.";
            header("Location: viewProducts.php"); // Redirect after deletion
            exit(); // Make sure to exit after redirect
        } else {
            echo "Error deleting product: " . mysqli_error($db_Connection);
        }
    }


    // Check if a new image is being uploaded
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $target_dir = "productUploads/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["image_url"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], "$target_file")) {
                $image_url = $target_file; // Update the image URL with the new file
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update the product in the database
    $updateQuery = "UPDATE products SET 
        image_url='$image_url', 
        price='$price', 
        category='$category', 
        subcategory='$subcategory', 
        description='$description' 
        WHERE id='$productId'";

    if (mysqli_query($db_Connection, $updateQuery)) {
        echo "Product updated successfully.";
        header("Location: viewProducts.php"); // Change this to your actual view product page
        exit(); // Make sure to exit after the header redirect
    } else {
        echo "Error updating product: " . mysqli_error($db_Connection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="addProductStyles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container"> 
        <h2>Edit Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <table style="width: 100%; background-color: var(--nav-color); color: var(--text-color); border-color: var(--footer-color);">
                <tr>
                    <td><label for="image_url">Product Image:</label></td>
                    <td>
                        <input type="file" name="image_url" id="image_url">
                        <input type="hidden" name="existing_image" value="<?php echo $product['image_url']; ?>">
                        <br>
                        <img src="<?php echo $product['image_url']; ?>" alt="Current Product Image" style="width: 100px; height: auto;">
                    </td>
                </tr>
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" step="0.01" name="price" id="price" value="<?php echo $product['price']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="category">Category:</label></td>
                    <td>
                        <select name="category" id="category" required onchange="updateSubcategories()">
                            <option value="">Select a category</option>
                            <option value="rods" <?php if($product['category'] == 'rods') echo 'selected'; ?>>Rods</option>
                            <option value="reels" <?php if($product['category'] == 'reels') echo 'selected'; ?>>Reels</option>
                            <option value="lures" <?php if($product['category'] == 'lures') echo 'selected'; ?>>Lures</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="subcategory">Sub-Category:</label></td>
                    <td>
                        <select name="subcategory" id="subcategory" required>
                            <option value="">Select a sub-category</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea name="description" id="description" rows="4" required><?php echo $product['description']; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Update Product</button></td>
                    <td colspan="2">
                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this product?');" style="background-color: red; color: white;">
                            Delete Product
                        </button>
                    </td>
                </tr>
                <tr>
            </table>
        </form>
    </div>

    <script>
        // Populate the subcategory based on the selected category
        function updateSubcategories() {
            const category = document.getElementById('category').value;
            const subcategorySelect = document.getElementById('subcategory');
            
            subcategorySelect.innerHTML = '<option value="">Select a sub-category</option>';
            
            let subcategories = [];
            
            switch (category) {
                case "rods":
                    subcategories = ["Saltwater Rod", "Freshwater Rod", "Spinning Rod"];
                    break;
                case "reels":
                    subcategories = ["Baitcasting Reel", "Spinning Reel", "Fly Reel"];
                    break;
                case "lures":
                    subcategories = ["Jigs", "Crankbaits", "Spinnerbaits", "Topwater Lures"];
                    break;
                default:
                    break;
            }

            subcategories.forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory;
                option.textContent = subcategory;
                subcategorySelect.appendChild(option);
            });

            // Set the selected subcategory based on the current product
            const currentSubcategory = "<?php echo $product['subcategory']; ?>";
            if (currentSubcategory) {
                subcategorySelect.value = currentSubcategory;
            }
        }

        // Call the function to set initial subcategories based on the selected category
        updateSubcategories();
    </script>
</body>
</html>

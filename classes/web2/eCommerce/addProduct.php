<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="addProductStyles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <?php include 'nav.php'; ?>
    <?php
    include 'config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "productUploads/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if image file is an actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image_url"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }


        if ($uploadOk == 1) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], "$target_file")) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image_url"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }

            $sql = "INSERT INTO products VALUES (
            NULL, '".
            $target_file."', '".
            $_POST['price']."', '".
            $_POST['category']."', '".
            $_POST['subcategory']."', '".
            $_POST['description']."')";
        
    
            echo "The SQL this is going to do the INSERT: <br>" . $sql;
    
            if ($_POST['description'] != "" && $_POST['description'] != "" ) {
                mysqli_query($db_Connection, $sql) or die ("The inesert did not work");
                echo "looks like the insert worked";
                $_POST['description'] == "";
            }

        }
    }


    ?>


    <div class="container"> 
<h2>Add New Product</h2>
<form action="addProduct.php" method="POST" enctype="multipart/form-data">
    <label for="image_url">Product Image:</label>
    <input type="file" name="image_url" id="image_url"><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" id="price" required><br>

    <label for="category">Category:</label>
    <select name="category" id="category" required onchange="updateSubcategories()">
        <option value="">Select a category</option>
        <option value="rods">Rods</option>
        <option value="reels">Reels</option>
        <option value="lures">Lures</option>
    </select><br>

    <label for="subcategory">Sub-Category:</label>
    <select name="subcategory" id="subcategory" required>
        <option value="">Select a sub-category</option>
    </select><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" required></textarea><br>

    <button type="submit">Add Product</button>
</form>
<script>
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
    }
</script>
</div>
</body>
</html>

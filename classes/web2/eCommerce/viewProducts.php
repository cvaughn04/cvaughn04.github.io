<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js" defer></script>

</head>
<body>
    <?php include 'config.php';?>
    <?php include 'nav.php';?>

    <?php
        $products = mysqli_query($db_Connection, "SELECT * FROM products") or die ("The query didnt ork");

    $numRecords = mysqli_num_rows($products);

    echo "<table border='1' 
    style='
        background-color: var(--nav-color);
        border-color: var(--footer-color);
        color: var(--text-color);
        align-self: center;
        width: 70%;
        margin-top: 50px;
        
    '";
    echo "<tr>
          <th>id</th>
          <th>image_url</th>
          <th>price</th>
          <th>category</th>
          <th>subcategory</th>
          <th>description</th>

          </tr>";

    while($row = mysqli_fetch_array($products)) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td><img src='".$row["image_url"]."' alt='Product Image' style='width:100px;height:auto;'></td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["category"]."</td>";
        echo "<td>".$row["subcategory"]."</td>";
        echo "<td>".$row["description"]."</td>";

        echo "<td><a href='editProduct.php?id=".$row["id"]."'>Edit</a></td>"; 
        echo "</tr>";


    }



    mysqli_close($db_Connection);
    ?>
    
</body>

</html>


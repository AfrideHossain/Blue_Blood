<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <!--Top Navigation Bar Start-->
    <header class="top_nav_bar">
        <div class="logoNsearch">
            <div class="logo-side">
                <!--<img src="images/logo2.png" alt="" />-->
                <h2>BlueBlood</h2>
            </div>
        </div>
    </header>
    <!--Top Navigation Bar End-->
    <div class="page_title">
        <h1>Add Product</h1>
    </div>
    <section class="add_product_box">
        <div class="img_prev">
            <img id="prev_img" src="" alt="">
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="product_info">
                <input type="file" name="product_img" id="product_img" required>
                <input type="text" name="product_name" id="product_name" placeholder="Product name" required>
                <input type="text" name="price" id="price" placeholder="Set price" required>
                <input type="text" name="stock" id="stock" placeholder="Stock" required>
                <input type="submit" id="addBtn" name="addBtn" value="Add" required>

            </div>
        </form>
    </section>
    <!-- <script>
        
    </script> -->
    <!-- Functions goes here -->
    <?php
    include '../../config/dbcon.php';
    function input_tester($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_POST["addBtn"])) {
        // echo getcwd();
        // chdir('../../images');
        // echo getcwd();
        $file_dest = "../../images/";
        $fr_db_file_dest = "images/" . basename($_FILES["product_img"]['name']);
        $target_file = $file_dest . basename($_FILES["product_img"]['name']);
        $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
        if (!$conn) {
            die("Connection ailed" . mysqli_connect_error());
        }
        $insert = "INSERT INTO products(product_name, price, stock, product_img) VALUES ('$product_name', '$price', '$stock', '$fr_db_file_dest')";

        if (mysqli_query($conn, $insert) and move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
            echo "File uploaded and information added to database";
        } else {
            echo  mysqli_error($conn);
        }
    }
    ?>
</body>

</html>
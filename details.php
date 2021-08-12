<?php
// include "config/dbcon.php";
session_start();
if (!$_COOKIE["loggedin"] == 1) {
    echo "<script>window.location.href = 'login/login.php';</script>";
} else {
    $_SESSION["user_id"] = $_COOKIE["user_id"];
    $_SESSION["loggedin"] = 1;
}

?>
<?php
if (isset($_GET["product"])) {
    include "config/dbcon.php";
    $pid = mysqli_real_escape_string($conn, $_GET["product"]);
    $sql = "SELECT * FROM products WHERE product_id = '$pid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        // print_r($product);
        // echo $product["product_img"];
        $product_json = json_encode($product);
    } else {
        echo "<script>window.location.href = 'index.php';</script>";
    }
    //echo $product_json;
    //echo $product["product_id"];
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="details.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>BlueBlood | Ornament Your Haven</title>
</head>

<body>
    <!--Top Navigation Bar Start-->
    <header>
        <!-- class="top_nav_bar" -->
        <div class="logoNsearch">
            <!-- <div class="side-menu-icon">
                            <i id="close-menu" class="fa fa-times" onclick="closeMenu()"></i>
                            <i id="open-menu" class="fa fa-bars" onclick="openMenu()"></i>
                        </div> -->
            <div class="logo-side">
                <!--<img src="images/logo2.png" alt="" />-->
                <h2>BlueBlood</h2>
            </div>
            <div class="search-side">
                <input type="text" name="search_word" id="searchBox" />
                <span class="fa fa-search"></span>
            </div>
        </div>
        <!-- <div class="top-nav-options">
                    <ul>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i>Cart</a></li>
                        <li><a href="#"><i class="fa fa-user-plus"></i>Sign up</a></li>
                        <li><a href="login/login.html"><i class="fa fa-sign-in"></i>Log In</a></li>
                    </ul>
                </div> -->
    </header>
    <section class="container">
        <div class="img-part">
            <img src="<?php echo $product["product_img"]; ?>" alt="" />
        </div>
        <div class="primary-info">
            <h2><?php echo $product["product_name"]; ?></h2>
            <div class="stocks">
                <h5><?php echo $product["price"]; ?>/=</h5>
                <h4>In stock: <span><?php echo $product["stock"]; ?></span></h4>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate</p>
        </div>
        <div class="buttons">
            <button id="buyBtn" class="btn btn-success">Buy Now</button>
            <button id="cartBtn" class="btn btn-primary">Add To Cart</button>
        </div>
    </section>
    <!--Top Navigation Bar End-->
    <footer id="footer-sec">
        <section id="footer">
            <div class="useful">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="login/login.html">Log In</a></li>
                    <li><a href="#">Create New Account</a></li>
                </ul>
            </div>
            <div class="company">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li>
                        <p>
                            Unknown street, Dhaka, Bangladesh
                        </p>
                    </li>
                    <li><a href="mailto:asafridehossain142@gmail.com?subject=feedback">asafridehossain142@gmail.com</a></li>
                    <li><a href="tel:+8801704760805">+8801704760805</a></li>
                </ul>
            </div>
            <div class="follow">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </section>
        <section class="copyright">
            <p>
                &#169; Copyright 2021 || BlueBlood
            </p>
        </section>
    </footer>
    <h2 id="test_elm"></h2>
    <script type="text/javascript">
        const cartBtn = document.getElementById("cartBtn");
        const test_elm = document.getElementById("test_elm")
        var json_product = <?php echo $product_json; ?>;

        cartBtn.onclick = function(){
            console.log("clicked");
            let jsonProductString = JSON.stringify(json_product);
            //test_elm.innerHTML = jsonProductString;
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = ()=>{
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            }
            xhr.open("POST", "addcart.php", true);
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(jsonProductString);            
        }
    </script>
</body>

</html>
<?php
// function addToCart($product)
// {
//     $cookie_arr = $_COOKIE["cart"];
//     if (sizeof($cookie_arr) > 0) {
//         $last_key = sizeof($cookie_arr);
//         setcookie("cart[$last_key]", $product, time() + 86400, "/");
//     } else {
//         setcookie("cart[0]", $product, time() + 86400, "/");
//     }
//     return "done";
    
// }
?>
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
include "config/dbcon.php";
$sql = "SELECT * FROM products";
$all_product = [];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<script> console.log('" . json_encode($row) . "'); </script>";
        array_push($all_product, $row);
    }
    // echo json_encode($all_product);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>BlueBlood | Ornament Your Haven</title>
</head>

<body>
    <!--Top Navigation Bar Start-->
    <header class="top_nav_bar">
        <div class="logoNsearch">
            <div class="side-menu-icon">
                <i id="close-menu" class="fa fa-times" onclick="closeMenu()"></i>
                <i id="open-menu" class="fa fa-bars" onclick="openMenu()"></i>
            </div>
            <div class="logo-side">
                <!--<img src="images/logo2.png" alt="" />-->
                <h2>BlueBlood</h2>
            </div>
            <div class="search-side">
                <input type="text" name="search_word" id="searchBox" />
                <span class="fa fa-search"></span>
            </div>
        </div>
        <div class="top-nav-options">
            <ul>
                <li><a href="cart.php"><i class="fa fa-shopping-cart"></i>Cart</a></li>
                <li><a href="login/signup.php" id="tp_sign"><i class="fa fa-user-plus"></i>Sign up</a></li>
                <li><a href="login/login.php" id="tp_log"><i class="fa fa-sign-in"></i>Log In</a></li>
            </ul>
        </div>
    </header>
    <!--Top Navigation Bar End-->

    <!--Side Menu Bar Start-->
    <section class="first-section">
        <div id="side-menu" class="side-menu">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="">FAQ</a></li>
            </ul>
            <div class="logins">
                <a class="side-create" href="login/signup.php" id="sd_sign"><i class="fa fa-user-plus"></i></a>
                <a class="side-login" href="login/login.php" id="sd_log"><i class="fa fa-sign-in"></i></a>
            </div>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/product1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Product 1</h5>
                        <p>
                            #001
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/product2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Product 2</h5>
                        <p>
                            #002
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/product3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Product 3</h5>
                        <p>
                            #003
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Side Menu Bar Start-->
    <!--Second section start-->
    <section class="container second-section">
        <div class="row text-center">
            <!-- Move all shuffle function into href -->
            <?php shuffle($all_product) ?>
            <div class="feature-item col-md-4">
                <!-- <a href="#"> <img class="" src="images/product2.jpg" alt="" /> </a> -->
                <a href="details.php?product=<?php $key = 0;
                                                echo $all_product[$key]["product_id"]; ?>"> <img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /> </a>
            </div>
            <div class="feature-item col-md-4">
                <a href="details.php?product=<?php $key = 1;
                                                echo $all_product[$key]["product_id"]; ?>"><img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /></a>
            </div>
            <div class="feature-item col-md-4">
                <a href="details.php?product=<?php $key = 2;
                                                echo $all_product[$key]["product_id"]; ?>"><img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /></a>
            </div>
        </div>
    </section>
    <!--Second section end-->

    <!--Third section start-->
    <section id="third-section">
        <div class="thrd-sec-title">
            <h2>Populer Items</h2>
        </div>
        <div class="container">
            <div class="row">
                <?php shuffle($all_product) ?>
                <div class="pop-item col-md-4 text-center">
                    <!-- <a href="#"><img src="images/product5.jpg" alt="" /></a> -->
                    <a href="details.php?product=<?php $key = 0;
                                                    echo $all_product[$key]["product_id"]; ?>"> <img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /> </a>
                    <!-- <h2>Wooden Table Watch</h2> -->
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <!-- <h4>Price: <span>400</span>Tk</h4> -->
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>

                <div class="pop-item col-md-4 text-center">
                    <!-- <a href="#"><img src="images/product6.jpg" alt="" /></a> -->
                    <a href="details.php?product=<?php $key = 1;
                                                    echo $all_product[$key]["product_id"]; ?>"> <img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /> </a>
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>

                <div class="pop-item col-md-4 text-center">
                    <a href="details.php?product=<?php $key = 2;
                                                    echo $all_product[$key]["product_id"]; ?>"><img src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /></a>
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>
            </div>
        </div>
    </section>
    <!--Third section end-->

    <!--fourth section start-->
    <section id="fourth-section">
        <div class="lat-items-bx-title">
            <h2>Latest Items</h2>
        </div>
        <div class="container">
            <div class="row">
                <?php shuffle($all_product) ?>
                <div class="lat-item col-md-4 text-center">
                    <!-- <a href="#"><img src="images/product5.jpg" alt="" /></a>
                    <h2>Wooden Table Watch</h2>
                    <h4>Price: <span>400</span>Tk</h4>
                    <a class="btn btn-primary" href="#">Add To Cart</a> -->
                    <!-- <a href="#"><img src="images/product5.jpg" alt="" /></a> -->
                    <a href="details.php?product=<?php $key = 0;
                                                    echo $all_product[$key]["product_id"]; ?>"> <img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /> </a>
                    <!-- <h2>Wooden Table Watch</h2> -->
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <!-- <h4>Price: <span>400</span>Tk</h4> -->
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>
                <div class="lat-item col-md-4 text-center">
                    <!-- <a href="#"><img src="images/product6.jpg" alt="" /></a> -->
                    <a href="details.php?product=<?php $key = 1;
                                                    echo $all_product[$key]["product_id"]; ?>"> <img class="" src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /> </a>
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>
                <div class="lat-item col-md-4 text-center">
                    <a href="details.php?product=<?php $key = 2;
                                                    echo $all_product[$key]["product_id"]; ?>"><img src="<?php echo $all_product[$key]["product_img"]; ?>" alt="" /></a>
                    <h2><?php echo $all_product[$key]["product_name"] ?></h2>
                    <h4>Price: <span><?php echo $all_product[$key]["price"] ?></span>Tk</h4>
                    <a class="btn btn-primary" href="details.php?product=<?php echo $all_product[$key]["product_id"]; ?>">Add To Cart</a>
                </div>
            </div>
        </div>

    </section>
    <!--fourth section end-->
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
    <!--For scripts only-->
    <script type="text/javascript">
        const openMenuBtn = document.getElementById("open-menu");
        const closeMenuBtn = document.getElementById("close-menu");
        const sideMenu = document.getElementById("side-menu");

        function openMenu() {
            openMenuBtn.style.display = "none"
            closeMenuBtn.style.display = "block"
            sideMenu.style.display = "block"
        }

        function closeMenu() {
            openMenuBtn.style.display = "block"
            closeMenuBtn.style.display = "none"
            sideMenu.style.display = "none"
        }
    </script>
    <script>
        const tp_log = document.getElementById("tp_log");
        const tp_sign = document.getElementById("tp_sign");
        const sd_log = document.getElementById("sd_log");
        const sd_sign = document.getElementById("sd_sign");
        const tp_logged = <?php echo $_COOKIE["loggedin"] ?>;
        if (tp_logged == 1) {
            tp_log.innerHTML = "<i class='fa fa-sign-out'></i>Log Out";
            tp_log.href = "logout.php";
            tp_sign.innerHTML = "<i class='fa fa-user-o'></i>Profile";
            tp_sign.href = "user.php";
            sd_log.innerHTML = "<i class='fa fa-sign-out'></i>";
            sd_log.href = "logout.php";
            sd_sign.innerHTML = "<i class='fa fa-user-o'></i>";
            sd_sign.href = "user.php";
        }
    </script>
</body>

</html>
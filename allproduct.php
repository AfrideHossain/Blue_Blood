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
    <style>
        #test_elm {
            position: absolute;
            width: 200px;
            text-align: center;
            background-color: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 200, 0, 1);
            border-radius: 5px;
            padding: 10px 0;
            font-size: .9em;
            margin-top: 5px;
            left: 10px;
            font-weight: 300;
            display: none;
        }
    </style>
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
                <h2 onclick="home()">BlueBlood</h2>
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
    <script>
        function home() {
            window.location.href = "index.php";
        }
    </script>
</body>

</html>
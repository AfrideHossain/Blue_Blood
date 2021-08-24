<?php
session_start();
session_unset();
session_destroy();
setcookie("loggedin", "", time() - 86400, "/");
setcookie("user_id", "", time() - 86400, "/");
$cart = $_COOKIE["cart"];
//print_r($cart);
for ($i = 0; $i < count($cart); $i++) {
    setcookie("cart[$i]", '', time() - 3600, "/");
}
header("location:login/login.php");

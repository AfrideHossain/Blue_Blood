<?php
$cart = $_COOKIE["cart"];
//print_r($cart);
for ($i=0; $i < count($cart); $i++) { 
    setcookie("cart[$i]", '', time()-3600, "/");
}
//setcookie("cart[0]", '', time()-3600, "/");
?>
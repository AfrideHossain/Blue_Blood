<?php
function addToCart($product)
{
    $cookie_arr = $_COOKIE["cart"];
    if (sizeof($cookie_arr) > 0) {
        $last_key = sizeof($cookie_arr);
        setcookie("cart[$last_key]", $product, time() + 86400, "/");
    } else {
        setcookie("cart[0]", $product, time() + 86400, "/");
    }
    return "done";
    
}
?>
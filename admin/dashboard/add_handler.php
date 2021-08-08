<?php
var_dump($_FILES);
foreach ($_FILES["product_img"]["tmp_name"] as $key => $value) {
    echo basename($_FILES["product_img"]["name"][$key]);
}

<?php
session_start();
session_unset();
session_destroy();
setcookie("loggedin", "", time() - 86400, "/");
setcookie("user_id", "", time() - 86400, "/");
header("location:login/login.php");

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
$n_pass = file_get_contents("php://input");
$passobj = json_decode($n_pass);
$pass =  $passobj->npass;
$pass = md5($pass);
$uid = $_COOKIE["user_id"];
// $n_pass = $_GET["npass"];
// echo $n_pass;
include "config/dbcon.php";
$sql = "UPDATE user_info SET pass = '$pass' WHERE user_id = '$uid'";
if (mysqli_query($conn, $sql)) {
    echo "Password has changed";
}
?>
<?php
include "config/dbcon.php";
session_start();
if (!$_COOKIE["loggedin"] == 1) {
    echo "<script>window.location.href = 'login/login.php';</script>";
} else {
    $_SESSION["user_id"] = $_COOKIE["user_id"];
    $_SESSION["loggedin"] = 1;
}

?>

<?php
function input_tester($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$offset = Input_tester($_GET["offset"]);
$sql = "SELECT * FROM products LIMIT $offset, 2";
$all_product = [];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<script> console.log('" . json_encode($row) . "'); </script>";
        array_push($all_product, $row);
    }
    echo json_encode($all_product);
}
?>
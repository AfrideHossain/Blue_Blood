<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>BlueBlood | Admin gateway</title>
</head>

<body>
    <section class="form-back">
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-title">
                <h2> Authentication </h2>
            </div>
            <div class="form-content">
                <div class="text-boxs">
                    <div class="input-sec">
                        <input type="text" name="user" id="user" placeholder="Username" required /> <i class="fa fa-user-o"></i>
                    </div>
                    <div class="input-sec">
                        <input type="password" name="pass" id="pass" placeholder="Password" required /><i class="fa fa-lock"></i>
                    </div>
                    <div class="submit-sec">
                        <input type="submit" name="submit" id="submit" value="Log In" />
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Functions goes here -->

    <?php

    include '../config/dbcon.php';
    function input_tester($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST["submit"])) {
        $user = input_tester($_POST["user"]);
        $pass = md5($_POST["pass"]);
        $sql = "SELECT username, pass FROM admin WHERE username = '$user'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($pass == $row["pass"]) {
                $data = 1;
                setcookie("admin", $data, time() + 86400, "/");
                session_start();
                $_SESSION["admin"] = 1;
                echo "<script>window.location.href = 'dashboard/';</script>";
            } else {
                echo "<script>window.location.href = 'index.php';</script>";
            }
        } else {
            echo "Error";
        }
    }
    ?>

    <!-- End -->
</body>

</html>
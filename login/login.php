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
    <section class="form-back">
        <form class="login-form" action="" method="post" accept-charset="utf-8">
            <div class="form-title">
                <h2>Try To Log In!</h2>
            </div>
            <div class="form-content">
                <div class="text-boxs">
                    <div class="input-sec">
                        <input type="email" name="mail" id="mail" placeholder="Email Address" required /> <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="input-sec">
                        <input type="password" name="pass" id="pass" placeholder="Password" required /><i class="fa fa-lock"></i>
                    </div>
                    <div class="submit-sec">
                        <input type="submit" name="submit" id="submit" value="Log In" />
                    </div>
                </div>
                <div class="link-bx">
                    <a href="#">Forgot Your Password?</a>
                </div>
                <div class="link-bx">
                    <p>
                        Not A Member? <a href="signup.php"> Signup Now!</a>
                    </p>
                </div>
            </div>
        </form>
    </section>
    <!-- Functions goes here -->

    <?php

    include 'dbcon.php';
    function input_tester($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_POST["submit"])) {
        $mail = input_tester($_POST["mail"]);
        $pass = md5($_POST["pass"]);
        // echo $mail;
        // echo $pass . "<br>";
        $sql = "SELECT user_id, pass FROM user_info WHERE email = '$mail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // echo $row["pass"] . "<br>";
            if ($pass == $row["pass"]) {
                $data = $row["user_id"];
                setcookie("user_id", $data, time() + 86400, "/");
                setcookie("loggedin", 1, time() + 86400, "/");
                session_start();
                $_SESSION["loggedin"] = 1;
                echo "<script>window.location.href = '../';</script>";
            } else {
                echo "<script>window.location.href = 'login.php';</script>";
            }
        } else {
            echo "Error";
        }
        // while ($row = mysqli_fetch_assoc($result)) {
        //     echo $row["pass"];
        //     echo $row["user_id"];
        // }
    }
    ?>

    <!-- End -->

</body>

</html>
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
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-title">
                <h2>Create New Account</h2>
            </div>
            <div class="form-content">
                <div class="text-boxs">
                    <div class="input-sec">
                        <input type="file" name="profile_pic" id="profile_pic" required> <i class="fa fa-image"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="user_name" id="user_name" placeholder="Username" required /> <i class="fa fa-user"></i>
                    </div>
                    <div class="input-sec">
                        <input type="email" name="mail" id="mail" placeholder="Email Address" required /> <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="prime_phone" id="prime_phone" placeholder="Primary Phone Number" required /> <i class="fa fa-phone"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="alt_phone" id="alt_phone" placeholder="Alternative Phone Number" required /> <i class="fa fa-phone"></i>
                    </div>
                    <div class="input-sec">
                        <input type="password" name="pass" id="pass" placeholder="Password" required /><i class="fa fa-lock"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="village" id="village" placeholder="Village" required /> <i class="fa fa-home"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="area" id="area" placeholder="Area" required /> <i class="fa fa-home"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="district" id="district" placeholder="District" required /> <i class="fa fa-home"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="division" id="division" placeholder="Division" value="Dhaka" required /> <i class="fa fa-home"></i>
                    </div>
                    <div class="input-sec">
                        <input type="text" name="country" id="country" placeholder="Country" value="Bangladesh" required /> <i class="fa fa-home"></i>
                    </div>
                    <div class="submit-sec">
                        <input type="submit" name="submit" id="submit" value="Create Account" />
                    </div>
                </div>
                <div class="link-bx">
                    <p>
                        Already Have An Account? <a href="login.php"> Login Now!</a>
                    </p>
                </div>
            </div>
        </form>
    </section>
    <!-- Fuction goes here -->

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
        $username = input_tester($_POST["user_name"]);
        $email = input_tester($_POST["mail"]);
        $prime_phone = input_tester($_POST["prime_phone"]);
        $alt_phone = input_tester($_POST["alt_phone"]);
        $password = md5($_POST["pass"]);
        $village = input_tester($_POST["village"]);
        $area = input_tester($_POST["area"]);
        $district = input_tester($_POST["district"]);
        $division = input_tester($_POST["division"]);
        $country = input_tester($_POST["country"]);
        // file upload system
        $file_name = $username . $prime_phone;
        $file_dest = "members/uploads/";
        $target_file = $file_dest . basename($_FILES["profile_pic"]["name"]);
        $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_target_file = $file_dest . $file_name . "." . $filetype;
        // if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $new_target_file)) {
        //     echo "file uploaded<br>";
        //     echo $new_target_file;
        // } else {
        //     echo "upload failed";
        // }
        $sql = "INSERT INTO user_info (username, email, prime_phone, alt_phone, village, area, district, division, country, profile_pic, pass) VALUES ('$username', '$email', '$prime_phone', '$alt_phone', '$village', '$area', '$district', '$division', '$country', '$new_target_file', '$password')";

        try {
            // move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $new_target_file);
            // mysqli_query($conn, $sql);
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $new_target_file) and mysqli_query($conn, $sql)) {
                echo "<script>window.location.href = 'login.php';</script>";
            } else {
                echo "<script>window.location.href = 'signup.php';</script>";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    ?>

    <!-- End -->
</body>

</html>
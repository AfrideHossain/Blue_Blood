<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mailver.css" type="text/css" media="all" />
    <title>Confirmation</title>
</head>
<body>
    <section class="background">
        <form class="form-body" method="post">
            <h2>Confirmation Code</h2>
            <div class="msg-bx confirm-bx">
                <p>
                    The verification code has been successfully sent to the email address you provided. The code will expire after 5 minutes.
                </p>
            </div>
            <?php
            $sqlserver = "localhost";
            $slquser = 'id16775582_mask007';
            $password = 'AsdfQwer@#12';
            $db = 'id16775582_mask';
            $table = 'valid_users';
            $conn = mysqli_connect($sqlserver, $slquser, $password, $db);
            function input_tester($data) {

                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if (isset($_POST["verify"])) {
                $pr_code = input_tester($_POST["code"]);
                if ($pr_code == $_COOKIE["code"]) {
                    $uname = $_COOKIE["uname"];
                    $umail = $_COOKIE["mail"];
                    $sql = "INSERT INTO valid_users(username, user_email) VALUES ('$uname', '$umail')";
                    try{
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        echo "<div class='msg-bx' style='background-color: rgba(0,255,0, 0.1); border: 1px solid rgb(0,235,10);'><p><a href='index.php' style = 'text-decoration: none; padding: 4px 10px; background: #005fff; color: #fff; border: none; outline: none; border-radius: 3px;'>Let's start Journey</a></p></div>";
                    }
                    catch (Exception $e) {
                        echo $e;
                    }
                    /*mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    //setcookie("mail", "", time() - 3600);

                    //setcookie("uname", "", time() - 3600);

                    //setcookie("code", "", time() - 3600);
                    echo "<div class='msg-bx' style='background-color: rgba(0,255,0, 0.1); border: 1px solid rgb(0,235,10);'><p><a href='index.php' style = 'text-decoration: none; padding: 4px 10px; background: #005fff; color: #fff; border: none; outline: none; border-radius: 3px;'>Let's start Journey</a></p></div>";
                    //header("Location: index.php");
                    */
                } else {
                    echo "<div class='msg-bx' style='background-color: rgba(255,0,0, 0.1); border: 1px solid rgb(255,0,0); text-align: center;'><p>Confirmation code is wrong.</p></div>";
                }

            }
            ?>
            <input type="text" name="code" id="code" placeholder="Code" required />
            <input type="submit" name="verify" id="verify" value="Verify" />
        </form>
    </section>
</body>
</html>
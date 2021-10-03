<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

function input_tester($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mailer = new PHPMailer(true);

if (isset($_POST["submit"])) {
    //echo "Your request is being processing...";
    $name = input_tester($_POST["name"]);
    $mail = htmlspecialchars($_POST["email"]);
    $security_code = strval(rand(100000, 999999));
    $mbody = "<div style='font-size: 1.2em; padding: 5px;'>

            <div style='border-bottom: 1px solid gray;'>
                <p style='color: red; font-weight: bold; margin: 0; padding: 0; font-size: 2.5em; line-height:0;'>MASK</p>
            <p style='color: orange; font-weight: bold; font-size: 1.4em;'>Wear a mask and tell the truth</p>
            </div>
            <p>
                Hello $name, <br><br>Thanks for joining our community. We will keep your informations secret. Here is your confirmation code:
            </p>
            <br>
            <span style='background: rgba(0,191,239,0.1); font-size: 1.2em; border: 1px solid #00b1dd; margin: 5px 0px; border-radius: 3px; padding: 10px 30px; margin: 10px 0px; font-weight: bold; text-align: center;'>$security_code
            </span>
            <br>
            <p style='margin-top: 25px;'>Happy Journey</p>
        </div>";

    $sqlserver = "localhost";
    $slquser = 'id16775582_mask007';
    $password = 'AsdfQwer@#12';
    $db = 'id16775582_mask';
    $table = 'valid_users';
    $conn = mysqli_connect($sqlserver, $slquser, $password, $db);
    $sql = "SELECT username FROM valid_users WHERE user_email = '$mail'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: index.php");
    } else {
        try {
            /*$mailer->SMTPDebug  = 3;*/
            $mailer -> isSMTP();
            $mailer -> Host = 'smtp.gmail.com';
            $mailer -> SMTPAuth = true;
            $mailer -> Username = 'maskfreedom093@gmail.com';
            $mailer -> Password = 'asdqwe@#12';
            $mailer -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer -> Port = '587';

            $mailer -> setFrom('maskfreedom093@gmail.com');
            $mailer -> addAddress($mail);
            $mailer -> isHTML(true);
            $mailer -> Subject = "Confirm to continue at MASK.";
            $mailer -> Body = $mbody;
            $mailer -> send();
            /*echo "<script> alert('Thanks for contacting us.\nWe will get back to you as soon as possible.'); </script>";*/
            /*setcookie("mail", "", time() - 3600);
        setcookie("uname", "",time() - 3600);
        setcookie("code", "",time() - 3600);*/
            setcookie("mail", $mail, time() + 300, "/");
            setcookie("uname", $name, time() + 300, "/");
            setcookie("code", $security_code, time() + 300, "/");
            header("Location: confirmation.php");
        }
        catch (Exception $e) {
            echo "An error occured while sending Email.";
        }
    }
} else {
    header("Location: mailver.php");
}
?>
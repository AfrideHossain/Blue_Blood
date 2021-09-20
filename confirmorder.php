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
$customer = file_get_contents("php://input");
$customer_info = json_decode($customer);
// print_r($customer_info);
// print_r($customer_info->cart);
// print_r($customer_info->email);
// Getting customer info done

//Mailer odject start
use PHPMailer\PHPMailer\PHPMailer;

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

function input_tester($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//$mailer = new PHPMailer(true);
$cart_items = $customer_info->cart; //convert json to object
//print_r($cart_items);
$products_str = "<tr> <td> ID </td> <td> Product  </td> <td> Price </td></tr>"; //An empty string for adding products into mbody;
for ($i = 0; $i > count($cart_items); $i++) {
    //$products_str .= "<tr> <td>" . $items["product_id"] . "</td> <td>" . $items["product_name"] . "</td> <td>" . $items["price"] . "</td></tr>";
    // echo $cart_items[$i];s
    $item = json_decode($cart_items[$i]);
    $products_str .= "<tr> <td>" . $item["product_id"] . "</td> <td>" . $item["product_name"] . "</td> <td>" . $item["price"] . "</td></tr>";
}
// Email's body
/*<span style='background: rgba(0,191,239,0.1); font-size: 1.2em; border: 1px solid #00b1dd; margin: 5px 0px; border-radius: 3px; padding: 10px 30px; margin: 10px 0px; font-weight: bold; text-align: center;'>$products_str
            </span>*/
// $mbody = "<div style='font-size: 1.2em; padding: 5px;'>

//             <div style='border-bottom: 1px solid gray;'>
//                 <p style='color: red; font-weight: bold; margin: 0; padding: 0; font-size: 2.5em; line-height:0;'>BlueBlood</p>
//             <p style='color: orange; font-weight: bold; font-size: 1.4em;'>Ornament your heaven</p>
//             </div>
//             <p>
//                 Hello $customer_info->name, <br><br>We have received your request. We will confirm the present status of your order in the return mail as soon as we confirm your order.
//             </p>
//             <br>
//             <table tyle='width: 300px;background: rgba(0,191,239,0.1); font-size: 1.2em; border: 1px solid #00b1dd; margin: 5px 0px; border-radius: 3px; padding: 10px 30px; margin: 10px 0px; font-weight: bold; text-align: center;'>
//             $products_str
//             </table>
//             <br>
//             <p style='margin-top: 25px;'>Happy Journey</p>
//         </div>";
$flink = "http://127.0.0.1/blueblood/images/user_avatar.jpg";
$mbody = "<div style='font-size: 1.2em; padding: 5px;'>

            <div style='border-bottom: 1px solid gray;'>
                <p style='color: red; font-weight: bold; margin: 0; padding: 0; font-size: 2.5em; line-height:0;'>BlueBlood</p>
            <p style='color: orange; font-weight: bold; font-size: 1.4em;'>Ornament your heaven</p>
            </div>
            <p>
                Hello $customer_info->name, <br><br>We have received your request. We will confirm the present status of your order in the return mail as soon as we confirm your order.
            </p>
            <br>
            <a href='$flink'>download now</a>
            <br>
            <p style='margin-top: 25px;'>Happy Journey</p>
        </div>";
$clientMailSub = "Product confirmation related.";
//send mail function
function sendmail($toAddr, $mailSub, $mailBody)
{
    $mailEngine = new PHPMailer(true);
    try {
        // $mailEngine->SMTPDebug  = 3;
        $mailEngine->isSMTP();
        $mailEngine->Host = 'smtp.gmail.com';
        $mailEngine->SMTPAuth = true;
        $mailEngine->Username = 'maskfreedom093@gmail.com';
        $mailEngine->Password = ''  /*SMTP Pass goes here*/;
        $mailEngine->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailEngine->Port = '587';
        $mailEngine->setFrom('maskfreedom093@gmail.com');
        $mailEngine->addAddress($toAddr);
        $mailEngine->isHTML(true);
        $mailEngine->Subject = $mailSub;
        $mailEngine->Body = $mailBody;
        $mailEngine->send();
        echo "Thanks for your contribution.";
    } catch (Exception $e) {
        echo "An error occured while sending feedback.<br>";
        echo $e->getMessage();
    }
}
$cmail = $customer_info->email;
sendmail($cmail, $clientMailSub, $mbody);
?>
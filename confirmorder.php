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
$customer = file_get_contents("php://input");
$customer_info = json_decode($customer);

//Mailer odject start
use PHPMailer\PHPMailer\PHPMailer;

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

//import mpdf autoload
require_once __DIR__ . '/vendor/autoload.php';

function input_tester($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$order_id = $_COOKIE["user_id"] . date("HisdmY");  //order Id
//$order_id = intval($order_id);  //convert string to Int
//echo $order_id;
//echo gettype($order_id);
$cart_items = $_COOKIE["cart"];
$html = "<style>
      .header
      {
        width: 6in;
        font-family: Sans-Serif;
      }
      .header h2
      {
        width: 100%;
        text-align: center;
        color:  #1e90ff;
        font-size: 30px;
      }
      .header p
      {
        width: 100%;
        text-align: center;
        color: #FF2F2F;
      }
      .order_details
      {
        width: 6in;
        display: flex;
        justify-content: center;
      }
      table
      {
        width: 300px;
        margin: 0 auto;
        border: 1px solid #FF2F2F;
        font-family: Sans-Serif;
      }
      th
      {
        background: #e2e2e2;
        padding: 5px 0;
      }
      td
      {
        padding: 3px 0;
        text-align: center;
      }
      .total
      {
        width: 6in;
        display: flex;
        justify-content: right;
        color: rgb(255, 115, 0);
      }
    </style>";
$html .= "<div class='header'>
      <h2>BlueBlood</h2>
      <p>Order ID: <span>$order_id</span></p>
      <p>Total Price: <span>$customer_info->total</span></p>
    </div>
    <div class='order_details'>
      <table>
        <tr>
          <th>ID</th>
          <th>Product</th>
          <th>price</th>
        </tr>";
$cart_len = count($cart_items);
$i = 0;
while ($i <= $cart_len - 1) {
  $item = json_decode($cart_items[$i]);
  $html .= "<tr> <td>" . $item->product_id . "</td> <td>" . $item->product_name . "</td> <td>" . $item->price . "</td></tr>";
  $i++;
}
$html .= "</table></div>";
//echo $html;

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$fileName = "blueblood_" . $order_id . ".pdf";
$file = "orders/" . $fileName;
$mpdf->Output($file, 'F');

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
$mbody = "<div style='font-size: 1.2em; padding: 5px;'>

            <div style='border-bottom: 1px solid gray;'>
                <p style='color: red; font-weight: bold; margin: 0; padding: 0; font-size: 2.5em; line-height:0;'>BlueBlood</p>
            <p style='color: orange; font-weight: bold; font-size: 1.4em;'>Ornament your heaven</p>
            </div>
            <p>
                Hello $customer_info->name, <br><br>We have received your request. We will confirm the present status of your order in the return mail as soon as we confirm your order.
            </p>
            <br>
            <p style='margin-top: 10px;'>Have a good day</p>
        </div>";
$clientMailSub = "Product confirmation related.";
//send mail function
function sendmail($toAddr, $mailSub, $mailBody, $file, $fileName)
{
  $mailEngine = new PHPMailer(true);
  try {
    // $mailEngine->SMTPDebug  = 3;
    $mailEngine->isSMTP();
    $mailEngine->Host = 'smtp.gmail.com';
    $mailEngine->SMTPAuth = true;
    $mailEngine->Username = 'maskfreedom093@gmail.com';
    $mailEngine->Password = 'QwerAsdf@#12'  /*SMTP Pass goes here*/;
    $mailEngine->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailEngine->Port = '587';
    $mailEngine->setFrom('maskfreedom093@gmail.com');
    $mailEngine->addAddress($toAddr);
    $mailEngine->addAttachment($file, $fileName);
    $mailEngine->isHTML(true);
    $mailEngine->Subject = $mailSub;
    $mailEngine->Body = $mailBody;
    $mailEngine->send();
    //echo "Thanks for your contribution.<br>";
  } catch (Exception $e) {
    echo "An error occured while sending feedback.<br>";
    echo $e->getMessage();
  }
  return true;
}

$uid = $_COOKIE["user_id"];
$cmail = $customer_info->email;
$sql = "INSERT INTO orders (order_id, user_id, username, total_price, receipt_file) VALUES ('$order_id', '$uid', '$customer_info->name', '$customer_info->total', '$file')";
if (mysqli_query($conn, $sql)) {
  if (sendmail($cmail, $clientMailSub, $mbody, $file, $fileName)) {
    echo "Your order has been placed successfully.";
  }
} else {
  echo "An error occured.";
}


// $cmail = $customer_info->email;
// sendmail($cmail, $clientMailSub, $mbody);
// insertOrder($order_id, $_COOKIE["user_id"], $customer_info->name, $customer_info->total, $file, $fileName);
?>
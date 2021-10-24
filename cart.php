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
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="details.css" />
    <link rel="stylesheet" href="cart.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>BlueBlood | Ornament Your Haven</title>
    <style>
        .errMsg {
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            font-weight: 600;
            color: #c1c1c1;
        }

        .msg-sec {
            z-index: 10;
            background-color: rgba(0, 0, 255, .2);
            display: none;
            justify-content: center;
            align-items: center;
            min-height: 50px;
            width: 320px;
            margin: 0 auto;
            padding: 5px;
            border: 1px solid rgba(0, 0, 255, 1);
            border-radius: 5px;
        }

        .msg-sec p {
            line-height: 1;
            margin: auto 0;
            color: rgba(21, 21, 21, .8);
        }
    </style>
</head>

<body>
    <!--Top Navigation Bar Start-->
    <header>
        <!-- class="top_nav_bar" -->
        <div class="logoNsearch">
            <!-- <div class="side-menu-icon">
                                        <i id="close-menu" class="fa fa-times" onclick="closeMenu()"></i>
                                        <i id="open-menu" class="fa fa-bars" onclick="openMenu()"></i>
                                    </div> -->
            <div class="logo-side">
                <!--<img src="images/logo2.png" alt="" />-->
                <h2 onclick="home()">BlueBlood</h2>
            </div>
            <div class="search-side">
                <input type="text" name="search_word" id="searchBox" />
                <span class="fa fa-search"></span>
            </div>
        </div>
        <!-- <div class="top-nav-options">
                            <ul>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i>Cart</a></li>
                                <li><a href="#"><i class="fa fa-user-plus"></i>Sign up</a></li>
                                <li><a href="login/login.html"><i class="fa fa-sign-in"></i>Log In</a></li>
                            </ul>
                        </div> -->
    </header>
    <p id="test_el"></p>
    <?php
    include_once "config/dbcon.php";
    $uid = $_SESSION["user_id"];
    // $get_sql = "SELECT * FROM user_info WHERE user_id = '$_SESSION["user_id"]'";
    $get_sql = "SELECT * FROM user_info WHERE user_id = '$uid'";
    $result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // $userJson = json_encode($row);
            $userJson = $row;
        }
        // print_r($userJson);
    } else {
        echo "<script>
        console.error(" . mysqli_error($conn) . ")
    </script>";
    }
    ?>
    <div class="msg-sec" id="msg-sec">
        <p class="msg-content" id="msg-content">Your request is being processing...</p>
    </div>
    <div id="delivery_box" class="delivery_box">
        <div id="close_shipping"><span>&#x2715</span></div>
        <div class="box_title">
            <h2>Shipping</h2>
        </div>
        <div class="get_address">
            <div class="input_pair">
                <input type="text" name="name" id="name" placeholder="Full name" value="<?php echo $userJson["username"] ?>" required />
                <input type="tel" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $userJson["prime_phone"] ?>" required />
            </div>
            <div class="input_pair">
                <input type="tel" name="alt_phone" id="alt_phone" placeholder="Alternative Phone" value="<?php echo $userJson["alt_phone"] ?>" required />
                <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $userJson["email"] ?>" required />
            </div>
            <div class="input_pair">
                <input type="text" name="village" id="village" placeholder="Village" value="<?php echo $userJson["village"] ?>" required />
                <input type="text" name="area" id="area" placeholder="Area" value="<?php echo $userJson["area"] ?>" required />
            </div>
            <div class="input_pair">
                <input type="text" name="district" id="district" placeholder="District" value="<?php echo $userJson["district"] ?>" required />
                <input type="text" name="country" id="country" placeholder="Country" value="<?php echo $userJson["country"] ?>" required />
            </div>
            <div class="confirm_box">
                <p>Cash on delivery</p>
                <button id="confirm_shipping" class="btn btn-success">Confirm</button>
            </div>
        </div>
    </div>


    <section class="cart_body">
        <a href="user.php" id="user-avatar" class="user-avatar"><i class="fa fa-user-o"></i></a>
        <div class="cart_main" id="cart_main">
            <span id="clear_cart" class="clear_cart"><i class="fa fa-trash-o"></i></span>
            <h2>Shopping Cart</h2>
            <div id="order_details" class="order_details">
                <table id="order_table">
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    <?php
                    if (!isset($_COOKIE["cart"])) {
                        echo "<tr><p class='errMsg'>Cart is empty now</p></tr><script>document.getElementById('order_table').style.display = 'none';</script>";
                    }
                    ?>
                    <!--<tr>
                                            <td class="pid">#111</td>
                                            <td class="pname">Clock</td>
                                            <td class="price">400</td>
                                            <td><input type="number" class="quantity" value="1" /></td>
                                        </tr>
                                        <tr>
                                            <td class="pid">#112</td>
                                            <td class="pname">Vase</td>
                                            <td class="price">300</td>
                                            <td><input type="number" class="quantity" value="2" /></td>
                                        </tr>-->
                </table>
                <div class="total_price">
                    <p>
                        Total: <span id="total_price">0</span>/=
                    </p>
                    <button class="btn btn-success" id="order_btn">Order</button>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer-sec">
        <section id="footer">
            <div class="useful">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="login/login.html">Log In</a></li>
                    <li><a href="#">Create New Account</a></li>
                </ul>
            </div>
            <div class="company">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li>
                        <p>
                            Unknown street, Dhaka, Bangladesh
                        </p>
                    </li>
                    <li><a href="mailto:asafridehossain142@gmail.com?subject=feedback">asafridehossain142@gmail.com</a>
                    </li>
                    <li><a href="tel:+8801704760805">+8801704760805</a></li>
                </ul>
            </div>
            <div class="follow">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </section>
        <section class="copyright">
            <p>
                &#169; Copyright 2021 || BlueBlood
            </p>
        </section>
    </footer>
    <script type="text/javascript">
        const order_table = document.getElementById("order_table");
        const order_details = document.getElementById("order_details");
        const clear_cart = document.getElementById("clear_cart");
        const order_btn = document.getElementById("order_btn");
        const delivery_box = document.getElementById("delivery_box");
        const cart_main = document.getElementById("cart_main");
        const close_shipping = document.getElementById("close_shipping");
        order_btn.onclick = () => {
            delivery_box.style.display = "block";
            cart_main.style.display = "none";
        }

        close_shipping.onclick = function() {
            delivery_box.style.display = "none";
            cart_main.style.display = "block";
        }

        /*var cart = [{
                id: "#111",
                name: "clock",
                price: 300,
                quant: 1
            },
            {
                id: "#113",
                name: "table",
                price: 800,
                quant: 1
            },
            {
                id: "#112",
                name: "vase",
                price: 400,
                quant: 1
            },
            {
                id: "#113",
                name: "Horse Sculpture",
                price: 2000,
                quant: 1
            }
        ];*/
        var cart = [];
        let cart_json = <?php echo json_encode($_COOKIE["cart"]); ?>;
        for (let elm = 0; elm < cart_json.length; elm++) {
            cart.push(JSON.parse(cart_json[elm]));
        }
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        var val = 0;
        cart.forEach((obj) => {
            const tr = document.createElement("tr");
            for (let i = 0; i < 4; i++) {
                const td = document.createElement("td");
                if (i == 3) {
                    const input = document.createElement("input");
                    input.setAttribute('type', 'number');
                    input.setAttribute('class', 'quant');
                    input.setAttribute('value', 1);
                    //input.setAttribute('value', obj.quant);
                    input.setAttribute('oninput', "change(" + val + ")");
                    td.appendChild(input);
                    tr.appendChild(td);
                } else if (i == 0) {
                    td.setAttribute('class', 'id');
                    const txt = document.createTextNode(obj.product_id);
                    td.appendChild(txt);
                    tr.appendChild(td);
                } else if (i == 1) {
                    td.setAttribute('class', 'name');
                    const txt = document.createTextNode(obj.product_name);
                    td.appendChild(txt);
                    tr.appendChild(td);
                } else if (i == 2) {
                    td.setAttribute('class', 'price');
                    const txt = document.createTextNode(obj.price);
                    td.appendChild(txt);
                    tr.appendChild(td);
                } else {
                    console.log("Something went wrong");
                }
            }
            order_table.appendChild(tr);
            val++;
        });

        function get_total() {
            const total_price = document.getElementById("total_price");
            const price = document.getElementsByClassName("price");
            var total = 0;
            // price.forEach((value) => {
            //     total = total + parseInt(value.innerHTML);
            // });
            for (let i = 0; i < price.length; i++) {
                total = total + parseInt(price[i].innerHTML);
            }
            total_price.innerHTML = total;
        }
        get_total();

        function change(val) {
            const total_price = document.getElementById("total_price");
            const price = document.getElementsByClassName("price");
            const quant = document.getElementsByClassName("quant");
            let new_price = cart[val].price * quant[val].value;
            var total = 0;
            price[val].innerHTML = new_price;
            // price.forEach((value) => {
            //     total = total + parseInt(value.innerHTML);
            // });
            for (let i = 0; i < price.length; i++) {
                total = total + parseInt(price[i].innerHTML);
            }
            total_price.innerHTML = total;
        }

        clear_cart.onclick = cart_cleaner;

        function cart_cleaner() {
            //console.log(order_table);
            order_table.style.display = "none";
            let c = 0;
            while (c < cart.length) {
                cart.pop();
                // document.cookie = "cart["+c+"]="+";max-age=0";
                // document.cookie = "cart["+c+"]=;max-age=0";
                // document.cookie = `cart=`;
                c++;
            }
            let clear_cart_mod = new XMLHttpRequest();
            clear_cart_mod.open("GET", "clearcart.php", true);
            clear_cart_mod.send();
            let errTag = document.createElement("p");
            errTag.setAttribute('class', 'errMsg');
            let errTagMsg = document.createTextNode("Cart is empty now.");
            errTag.appendChild(errTagMsg);
            //order_details.appendChild(errTag);
            try {
                order_details.replaceChild(errTag, order_table);
            } catch (e) {
                //console.log(e);
            }

            total_price.innerHTML = "0";
            order_btn.disabled = true;
            order_btn.style.backgroundColor = "rgba(189,189,189,0.998)"
            order_btn.style.borderColor = "rgba(189,189,189,0.998)"
        }
    </script>
    <script>
        function home() {
            window.location.href = "index.php";
        }

        const confirm_shipping = document.getElementById("confirm_shipping");
        const msg_sec = document.getElementById("msg-sec");
        const msg_content = document.getElementById("msg-content");

        // shipping function
        confirm_shipping.addEventListener("click", () => {
            let customer_info = {
                name: document.getElementById("name").value,
                phone: document.getElementById("phone").value,
                altPhone: document.getElementById("alt_phone").value,
                email: document.getElementById("email").value,
                village: document.getElementById("village").value,
                area: document.getElementById("area").value,
                district: document.getElementById("district").value,
                cart: cart_json,
                total: total_price.innerHTML
            }
            customer_info = JSON.stringify(customer_info);
            //console.log(customer_info);
            msg_sec.style.display = "flex";
            let xhrOrder = new XMLHttpRequest();

            xhrOrder.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log("done");
                    msg_content.innerHTML = this.responseText;
                    cart_cleaner();
                    delivery_box.style.display = "none";
                    cart_main.style.display = "block";
                }
            };

            xhrOrder.open("POST", "confirmorder.php", true);
            xhrOrder.setRequestHeader("Content-type", "application/json");
            xhrOrder.send(customer_info);

        });
    </script>
</body>

</html>
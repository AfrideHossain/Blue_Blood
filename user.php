<?php
session_start();
if (!$_COOKIE["loggedin"] == 1) {
    echo "<script>window.location.href = 'login/login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="details.css" />
    <link rel="stylesheet" href="user.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>BlueBlood | Ornament Your Haven</title>
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
                <h2>BlueBlood</h2>
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

    <div class="pass_change_box" id="pass_change_box">
        <div id="close_pass_box"><span>&#x2715</span></div>
        <div class="pass_change_elements" id="pass_change_elements">
            <p>Set new password</p>
            <input type="text" name="new_pass" id="new_pass" class="pass_inp" placeholder="New password">
            <button id="n_pass_btn" class="btn btn-success">Confirm</button>
        </div>
    </div>

    <section class="user_profile_div">
        <div class="profileNshort">
            <div class="imageSec">
                <img id="user_avatar" src="images/user_avatar.jpg" alt="">
            </div>
            <div class="short">
                <h2 id="userName">Afride Hossain</h2>
                <h4 id="user_mail">asafridehossain142@gmail.com</h4>
                <button id="change_pass_btn" class="btn btn-info">Change Password</button>
            </div>
        </div>
        <div class="user_address_box">
            <div class="address_box_title">
                <p>You can't change your primary information</p>
            </div>
            <div class="user_address">
                <div class="data_pair">
                    <p>Primary Phone</p>
                    <p id="prime_phone">+8801704760805</p>
                </div>
                <div class="data_pair">
                    <p>Alt Phone</p>
                    <p id="alt_phone">+8801704760805</p>
                </div>
                <div class="data_pair">
                    <p>Village</p>
                    <p id="vill">Maguradangi</p>
                </div>
                <div class="data_pair">
                    <p>Area</p>
                    <p id="area">Pangsha</p>
                </div>
                <div class="data_pair">
                    <p>District</p>
                    <p id="district">Rajbari</p>
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
    <script>
        const change_pass_btn = document.getElementById("change_pass_btn");
        const close_pass_box = document.getElementById("close_pass_box");
        const pass_change_box = document.getElementById("pass_change_box");
        const new_pass = document.getElementById("new_pass");
        change_pass_btn.addEventListener("click", () => {
            pass_change_box.style.display = "block";
            pass_change_box.classList.add("fade_down");
        });
        close_pass_box.addEventListener("click", () => {
            pass_change_box.classList.add("fade_up");
            setTimeout(() => {
                pass_change_box.classList.remove("fade_down");
                pass_change_box.classList.remove("fade_up");
                pass_change_box.style.display = "none";
                new_pass.value = "";
            }, 1000);
        })
    </script>
    <?php
    include_once "config/dbcon.php";
    $uid = $_SESSION["user_id"];
    // $get_sql = "SELECT * FROM user_info WHERE user_id = '$_SESSION["user_id"]'";
    $get_sql = "SELECT * FROM user_info WHERE user_id = '$uid'";
    $result = mysqli_query($conn, $get_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userJson = json_encode($row);
        }
    } else {
        echo "<script>
        console.error(" . mysqli_error($conn) . ")
    </script>";
    }
    ?>
    <script>
        let js_user = <?php echo $userJson; ?>;
        const user_avatar = document.getElementById("user_avatar");
        document.getElementById("userName").innerHTML = js_user["username"];
        document.getElementById("user_mail").innerHTML = js_user["email"];
        document.getElementById("prime_phone").innerHTML = js_user["prime_phone"];
        document.getElementById("alt_phone").innerHTML = js_user["alt_phone"];
        document.getElementById("vill").innerHTML = js_user["village"];
        document.getElementById("area").innerHTML = js_user["area"];
        document.getElementById("district").innerHTML = js_user["district"];
        user_avatar.src = "login/" + js_user["profile_pic"];
    </script>
    <script>
        const n_pass_btn = document.getElementById("n_pass_btn");
        const pass_change_elements = document.getElementById("pass_change_elements");
        n_pass_btn.onclick = () => {
            let xhr = new XMLHttpRequest();
            let new_pass = document.getElementById("new_pass").value;
            // console.log(new_pass.value);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = this.responseText;
                    //console.log(response);
                    pass_change_elements.innerHTML = response;
                }
            };
            let pass_json = {
                npass : new_pass
            }
            pass_json = JSON.stringify(pass_json);
            //console.log(pass_json);
            
            xhr.open("POST", "passcng.php", true);
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.send(pass_json);
        }
    </script>
</body>

</html>
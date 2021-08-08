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

        echo $username;
        echo $email;
        echo $password;
        echo $prime_phone;
    }

    ?>

    <!-- End -->
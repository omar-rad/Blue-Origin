<?php
include './connection.php';
$errmsg = "";
if (!isset($_GET["code"]) && !isset($_POST["password1"])) {
    exit("Can't find page");
}

if (isset($_GET["code"])) {
    $code = $_GET["code"];
    $queryEmail = "SELECT email FROM resetpasswords WHERE (code = '$code')";
    $resultEmail = mysqli_query($con, $queryEmail);   //mysqli_query($con, "SELECT email FROM resetpasswords WHERE (code='$code)");

    if (mysqli_num_rows($resultEmail) == 0) {
        exit("Can't find page");
    }
}

if (isset($_POST["password1"]) && isset($_POST["password2"]) && ($_POST["password1"] === $_POST["password2"])) {

    $pw = $_POST["password1"];
    $pw = password_hash($pw, PASSWORD_BCRYPT);

    $row = mysqli_fetch_array($resultEmail);
    $email = $row["email"];

    $queryUpdate = "UPDATE user SET password='$pw' WHERE email='$email'";
    $resultUpdate = mysqli_query($con, $queryUpdate);

    if ($resultUpdate) {
        $queryDelete = "DELETE FROM resetpasswords WHERE code='$code'";
        $resultDelete = mysqli_query($con, $queryDelete);
        $errmsg = "Password updated";
        echo 'Password updated';  //change this when we update this page as a html
        sleep(3);
        header("Location: http://localhost/BlueOrigin/login.html");
        exit("Password updated");
        //go to login page 
    } else {
        $errmsg = "Try again";
        exit("Something went wrong");
        //go to login page  method = "post"       <script src="../resetPassword.js"></script>
    }
}
?>

<html lang="en">
    <head>
    <link rel="stylesheet" href="../styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Reset Password</title>
                    </head>
                    <body>
                    <div class="container">
                        <form class="form" id="reset" method = "post">
                            <h1 class="form__title">Reset Password?</h1>
                            <div class="form__message form__message--error">  
                                <a><?php
                                    error_reporting(E_ALL);
                                    if (!isset($_POST['password1'])) {
                                        $_POST['password1'] = "tempa";
                                        $_POST['password2'] = "tempa";
                                    }

                                    if (!($_POST['password1'] === $_POST['password2'])) {
                                        echo 'Try again';
                                    }
                                    ?></a>

                            </div>

                            <div class="form__input-group">
                                <input type="password" name="password1" class="form__input" id="password1" autofocus placeholder="New Password">
                                    <div class="form__input-error-message"></div>
                            </div>

                            <div class="form__input-group">
                                <input type="password" class="form__input form" name="password2" id="password2" autofocus placeholder="Repeat your new password">
                                    <div class="form__input-error-message"></div>
                            </div>

                            <button class="form__button" value="Update password" name="submit" type="submit">Submit</button>

                        </form>

                    </div>


                    </body>
                    </html>



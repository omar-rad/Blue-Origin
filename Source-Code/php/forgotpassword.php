<?php

include './connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if (isset($_POST["emailAddress"]) && !empty($_POST["phone"])) {
    //http_response_code(200);
} else {
    //http_response_code(406);
}

if (isset($_POST["emailAddress"]) && !empty($_POST["phone"])) {

    $email = $_POST['emailAddress'];
    $phone = $_POST['phone'];
    $code = uniqid(true);

    $query2 = "INSERT INTO resetpasswords(code, email) VALUES ('$code', '$email')";
    $result2 = mysqli_query($con, $query2);

    $query = "SELECT * FROM User WHERE (phoneNo = '$phone') and (email = '$email')";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'blueorigin.help@gmail.com';
            $mail->Password = 'BlueOrigin2022';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            //Recipients
            $mail->setFrom('blueorigin.help@gmail.com', 'Support');
            $mail->addAddress($email);
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
            $mail->isHTML(true);
            $mail->Subject = 'Password reset link';
            $mail->Body = "<h1>You requested a password reset</h1>"
                        . "You can reset your password in here: <a href ='$url'> link <a/>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    //echo $username;
    //echo $password;
}
        
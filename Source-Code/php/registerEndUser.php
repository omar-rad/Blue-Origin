<?php

session_start();
include './connection.php';

if (isset($_POST["signupUsername"]) && !empty($_POST["signupUsername"]) && ($_POST["password1"] === $_POST["password2"])) {

    $username = $_POST['signupUsername'];
    $email = $_POST['Email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password1'];
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $encPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "Insert INTO user (fName, lName, email, userName, password, phoneNo, address, companyName, userType) VALUES ('$firstName', '$lastName', '$email', '$username', '$encPassword', '$phone', '$address', 'NULL', 'EndUser')";

    $result = mysqli_query($con, $query);

    $query2 = "SELECT * FROM User WHERE (userName = '$username') and (password = '$encPassword')";

    $result2 = mysqli_query($con, $query2);

    if (mysqli_num_rows($result2) > 0) {

        $temp;
        while ($row = mysqli_fetch_assoc($result2)) {

            $temp = $row['userName'];
        }

        //Set session value
        $_SESSION['username'] = $username;

        //print_r($_SESSION);

        //http_response_code(200);
        //echo $_SESSION["user"];
        //redirect to homepage 
        //header("Location: dashboard.html");
    } else {
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        http_response_code(406);
        echo 'failed to register';
    }
}else {
    session_unset();
    // destroy the session

    http_response_code(406);
    session_destroy();
    echo 'failed to register';
}
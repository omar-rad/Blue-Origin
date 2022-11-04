<?php

session_start();
include './connection.php';

//CompanyRegister
if (isset($_POST["companyUsername"]) && !empty($_POST["companyUsername"]) && ($_POST["rpassword1"] == $_POST["rpassword2"])) {


    $username = $_POST['companyUsername'];
    $email = $_POST['companyEmail'];
    $address = $_POST['companyAddress'];
    $phone = $_POST['companyPhone'];
    $password = $_POST['rpassword1'];
    $encPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "Insert INTO user (fName, lName, email, userName, password, phoneNo, address, companyName, userType) VALUES ('NULL', 'NULL', '$email', '$username', '$encPassword', '$phone', '$address', '$username', 'Company')";

    $result = mysqli_query($con, $query);

    $query2 = "SELECT * FROM User WHERE (userName = '$username') and (password = '$encPassword')";

    $result2 = mysqli_query($con, $query2);

    if (mysqli_num_rows($result2) > 0) {

        $temp;
        while ($row = mysqli_fetch_assoc($result2)) {

            $temp = $row['userName'];
        }

        //Set session value
        $_SESSION['username'] = $temp;

        //print_r($_SESSION);

        http_response_code(200);
        //echo $_SESSION["user"];
        //redirect to homepage 
        //header("Location: dashboard.html");
        //EndUserRegister
    } else {
        // remove all session variables
        session_unset();
        // destroy the session

        http_response_code(406);
        session_destroy();
        echo 'failed to register';
    }
} else {
    session_unset();
    // destroy the session

    http_response_code(406);
    session_destroy();
    echo 'failed to register';
}



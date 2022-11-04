<?php
    session_start();
    include './connection.php';
    
    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
        http_response_code(200);
    
    } else {
       http_response_code(406);
    }

if (isset($_POST["username"]) && !empty($_POST["username"])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $encPassword; //= password_hash($password, PASSWORD_BCRYPT);
        
        $queryEnc = "SELECT * FROM User WHERE (userName = '$username')";
        $resultEnc = mysqli_query($con, $queryEnc);
        
        if (mysqli_num_rows($resultEnc)>0) {
            $temp;
            while ($rowEnc = mysqli_fetch_assoc($resultEnc)) {
                
                $encPassword = $rowEnc['password'];
                
            }
            
            if (password_verify($password, $encPassword)) {
                $_SESSION['username']=$username;
                http_response_code(200);
            } else {
                session_unset();
                // destroy the session
                session_destroy();
                http_response_code(406);
                echo 'failed to login';
            }
        } else {
            session_unset();
            // destroy the session
            session_destroy();
            http_response_code(406);
            echo 'failed to login';
        }
        
        //echo $username;
        //echo $password;
}
        
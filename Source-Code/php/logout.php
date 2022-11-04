<?php

    session_start();

    if (isset($_SESSION["username"])) {
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        http_response_code(406);    
    }
header("Location: //localhost/BlueOrigin/login.html");
die;
